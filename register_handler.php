<?php
// Start the session to manage user login state and flash messages
session_start();

// Include Composer's autoloader and the database connection
require 'vendor/autoload.php';
require 'includes/db.php';

// Use PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    // If not, redirect to the registration page
    header("Location: register.php");
    exit();
}

// --- 1. Input Validation ---
$errors = [];
$fullname = trim($_POST['fullname'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? ''; // No trim on password
$address = trim($_POST['address'] ?? '');
$city = trim($_POST['city'] ?? '');
$state = trim($_POST['state'] ?? '');
$country = trim($_POST['country'] ?? '');

if (empty($fullname)) $errors[] = "Full Name is required.";
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "A valid Email is required.";
if (empty($password) || strlen($password) < 8) $errors[] = "Password must be at least 8 characters long.";
if (empty($address)) $errors[] = "Contact Address is required.";
if (empty($city)) $errors[] = "City is required.";
if (empty($state)) $errors[] = "State is required.";
if (empty($country)) $errors[] = "Country is required.";

// File upload validation
if (empty($_FILES['id_front']['name'])) {
    $errors[] = "National ID Front / Passport is required.";
}

// If there are validation errors, redirect back to the form with errors
if (!empty($errors)) {
    $_SESSION['form_errors'] = $errors;
    // Store submitted data to re-populate the form
    $_SESSION['form_data'] = $_POST;
    header("Location: register.php");
    exit();
}

// --- 2. Check if user already exists ---
try {
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $_SESSION['form_errors'] = ["An account with this email address already exists."];
        $_SESSION['form_data'] = $_POST;
        header("Location: register.php");
        exit();
    }
} catch (PDOException $e) {
    // In production, log this error.
    die("Database error: Could not check for existing user.");
}

// --- 3. Handle File Uploads ---
$uploadDir = 'uploads/';
$idFrontPath = '';
$idBackPath = '';

function handleUpload($file, $uploadDir) {
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return [null, "File upload error with code: " . $file['error']];
    }
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
    if (!in_array($file['type'], $allowedTypes)) {
        return [null, "Invalid file type: " . $file['type']];
    }
    $fileName = uniqid('', true) . "_" . basename($file["name"]);
    $targetPath = $uploadDir . $fileName;
    if (move_uploaded_file($file["tmp_name"], $targetPath)) {
        return [$targetPath, null];
    } else {
        return [null, "Failed to move uploaded file."];
    }
}

list($idFrontPath, $error) = handleUpload($_FILES['id_front'], $uploadDir);
if ($error) {
    $errors[] = "Error with ID Front upload: " . $error;
}

if (!empty($_FILES['id_back']['name'])) {
    list($idBackPath, $error) = handleUpload($_FILES['id_back'], $uploadDir);
    if ($error) {
        $errors[] = "Error with ID Back upload: " . $error;
    }
}

if (!empty($errors)) {
    $_SESSION['form_errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header("Location: register.php");
    exit();
}


// --- 4. Generate OTP and Hash Password ---
$otp = rand(100000, 999999);
$otpExpiresAt = date('Y-m-d H:i:s', strtotime('+15 minutes'));
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


// --- 5. Insert User into Database ---
try {
    $sql = "INSERT INTO users (fullname, email, password, address, city, state, country, id_front_path, id_back_path, otp, otp_expires_at, is_verified) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $fullname,
        $email,
        $hashedPassword,
        $address,
        $city,
        $state,
        $country,
        $idFrontPath,
        $idBackPath,
        $otp,
        $otpExpiresAt
    ]);
    $userId = $pdo->lastInsertId();
} catch (PDOException $e) {
    // Clean up uploaded files if DB insert fails
    if (file_exists($idFrontPath)) unlink($idFrontPath);
    if (file_exists($idBackPath)) unlink($idBackPath);
    // In production, log this error.
    die("Database error: Could not register user. " . $e->getMessage());
}

// --- 6. Send OTP Email ---
$mail = new PHPMailer(true);
try {
    // Server settings - These should be in a config file or environment variables
    $mail->isSMTP();
    $mail->Host       = 'smtp.example.com'; // Your SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'noreply@flix9hub.com'; // Your SMTP username
    $mail->Password   = 'your_smtp_password'; // Your SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('noreply@flix9hub.com', 'Flix9 Hub');
    $mail->addAddress($email, $fullname);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Your Flix9 Hub Verification Code';
    $mail->Body    = "Hi $fullname,<br><br>Thank you for registering. Your verification code is: <h2>$otp</h2><br>This code will expire in 15 minutes.<br><br>Regards,<br>The Flix9 Hub Team";
    $mail->AltBody = "Your verification code is: $otp";

    $mail->send();
} catch (Exception $e) {
    // In a real app, you might want to handle this more gracefully
    // For now, we'll just show an error.
    // You might also want to delete the user record if the email fails.
    die("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
}

// --- 7. Redirect to Verification Page ---
// We can pass the user's email in the URL to pre-fill the form on the next page
$_SESSION['registration_success'] = "Registration successful! Please check your email for the verification code.";
header("Location: otp_verification.php?email=" . urlencode($email));
exit();

?>
