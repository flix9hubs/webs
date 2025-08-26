<?php
session_start();
require 'includes/db.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: otp_verification.php");
    exit();
}

$email = $_POST['email'] ?? '';
$otp_submitted = $_POST['otp'] ?? '';
$errors = [];

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email address provided.";
}
if (empty($otp_submitted) || !preg_match('/^\d{6}$/', $otp_submitted)) {
    $errors[] = "Please enter a valid 6-digit OTP.";
}

if (!empty($errors)) {
    $_SESSION['otp_errors'] = $errors;
    header("Location: otp_verification.php?email=" . urlencode($email));
    exit();
}

try {
    // Fetch the user by email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        $errors[] = "No user found with this email address.";
    } else if ($user['is_verified']) {
        $errors[] = "This account has already been verified. Please login.";
        // Redirect to login, as this is not really an OTP error
        $_SESSION['login_info'] = "This account is already verified. Please log in.";
        header("Location: login.php");
        exit();
    } else {
        // User exists and is not verified, check OTP
        if ($user['otp'] !== $otp_submitted) {
            $errors[] = "The OTP you entered is incorrect.";
        }

        // Check if OTP is expired
        $now = new DateTime();
        $otp_expires_at = new DateTime($user['otp_expires_at']);
        if ($now > $otp_expires_at) {
            $errors[] = "The OTP has expired. Please request a new one.";
        }
    }

    if (!empty($errors)) {
        $_SESSION['otp_errors'] = $errors;
        header("Location: otp_verification.php?email=" . urlencode($email));
        exit();
    }

    // --- Verification Successful ---
    // Update user status
    $update_stmt = $pdo->prepare("UPDATE users SET is_verified = 1, otp = NULL, otp_expires_at = NULL WHERE id = ?");
    $update_stmt->execute([$user['id']]);

    // Log the user in
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_fullname'] = $user['fullname'];

    // Redirect to a dashboard page (for now, index.php)
    $_SESSION['login_success'] = "Welcome, " . htmlspecialchars($user['fullname']) . "! Your account has been successfully verified.";
    header("Location: index.php"); // In the future, this will be investor_dashboard.php
    exit();

} catch (PDOException $e) {
    die("Database error during OTP verification: " . $e->getMessage());
} catch (Exception $e) {
    die("An unexpected error occurred: " . $e->getMessage());
}

?>
