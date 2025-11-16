<?php
session_start();
require 'includes/db.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit();
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$errors = [];

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "A valid email is required.";
}
if (empty($password)) {
    $errors[] = "Password is required.";
}

// If there are basic validation errors, redirect back
if (!empty($errors)) {
    $_SESSION['login_errors'] = $errors;
    header("Location: login.php");
    exit();
}

try {
    // Fetch user from the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Verify user exists and password is correct
    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, now check if account is verified
        if ($user['is_verified']) {
            // --- Login Successful ---
            session_regenerate_id(true); // Prevent session fixation
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_fullname'] = $user['fullname'];

            // Redirect to dashboard (index.php for now)
            $_SESSION['login_success'] = "Welcome back, " . htmlspecialchars($user['fullname']) . "!";
            header("Location: index.php");
            exit();
        } else {
            // User is not verified
            $_SESSION['otp_errors'] = ["Your account is not verified. Please enter the OTP that was sent to your email."];
            header("Location: otp_verification.php?email=" . urlencode($email));
            exit();
        }
    } else {
        // --- Login Failed ---
        // Generic error message to prevent account enumeration
        $_SESSION['login_errors'] = ["Invalid email or password."];
        header("Location: login.php");
        exit();
    }

} catch (PDOException $e) {
    die("Database error during login: " . $e->getMessage());
}
?>
