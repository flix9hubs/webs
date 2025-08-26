<?php
session_start();
require 'vendor/autoload.php';
require 'includes/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Get email from the URL
$email = $_GET['email'] ?? '';
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['otp_errors'] = ["Invalid email provided for resending OTP."];
    header("Location: otp_verification.php");
    exit();
}

try {
    // Find the user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user || $user['is_verified']) {
        $_SESSION['otp_errors'] = ["Cannot resend OTP for this account. It may not exist or is already verified."];
        header("Location: otp_verification.php?email=" . urlencode($email));
        exit();
    }

    // Generate a new OTP and expiration
    $otp = rand(100000, 999999);
    $otpExpiresAt = date('Y-m-d H:i:s', strtotime('+15 minutes'));

    // Update the user's record with the new OTP
    $update_stmt = $pdo->prepare("UPDATE users SET otp = ?, otp_expires_at = ? WHERE id = ?");
    $update_stmt->execute([$otp, $otpExpiresAt, $user['id']]);

    // Send the new OTP via email
    $mail = new PHPMailer(true);
    // Server settings (copied from register_handler.php)
    $mail->isSMTP();
    $mail->Host       = 'smtp.example.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'noreply@flix9hub.com';
    $mail->Password   = 'your_smtp_password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('noreply@flix9hub.com', 'Flix9 Hub');
    $mail->addAddress($user['email'], $user['fullname']);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Your New Flix9 Hub Verification Code';
    $mail->Body    = "Hi " . htmlspecialchars($user['fullname']) . ",<br><br>Here is your new verification code: <h2>$otp</h2><br>This code will expire in 15 minutes.";
    $mail->AltBody = "Your new verification code is: $otp";

    $mail->send();

    // Redirect back with a success message
    $_SESSION['otp_success'] = "A new verification code has been sent to your email address.";
    header("Location: otp_verification.php?email=" . urlencode($email));
    exit();

} catch (PDOException $e) {
    die("Database error while resending OTP: " . $e->getMessage());
} catch (Exception $e) {
    die("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
}

?>
