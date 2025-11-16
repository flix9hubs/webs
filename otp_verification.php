<?php
session_start();

$page_title = 'Verify Your Account - Flix9 Hub';
$page_css = ['css/pages.css'];
include 'includes/header.php';

// Pre-fill email from URL parameter for user convenience
$email = $_GET['email'] ?? '';

// Get messages from session
$success_message = $_SESSION['otp_success'] ?? $_SESSION['registration_success'] ?? '';
$errors = $_SESSION['otp_errors'] ?? [];

// Clear session variables
unset($_SESSION['otp_success']);
unset($_SESSION['registration_success']);
unset($_SESSION['otp_errors']);
?>

    <main class="page-content">
        <section class="otp-section">
            <h2>Enter Verification Code</h2>

            <?php if ($success_message): ?>
                <div class="form-success" style="background-color: #28a745; color: white; padding: 1rem; margin-bottom: 1rem; border-radius: 5px;">
                    <p><?php echo htmlspecialchars($success_message); ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="form-errors">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <p>We've sent a 6-digit verification code to your email address (<?php echo htmlspecialchars($email); ?>). Please enter it below.</p>

            <form action="otp_handler.php" method="POST" class="contact-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required readonly>
                </div>
                <div class="form-group">
                    <label for="otp">Verification Code</label>
                    <input type="text" id="otp" name="otp" pattern="\d{6}" title="Please enter a 6-digit code" maxlength="6" required autofocus>
                </div>
                <button type="submit" class="btn">Verify Account</button>
            </form>
            <p style="text-align:center; margin-top:1rem;">Didn't receive the code? <a href="resend_otp.php?email=<?php echo urlencode($email); ?>">Resend Code</a></p>
        </section>
    </main>

<?php include 'includes/footer.php'; ?>
