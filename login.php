<?php
session_start();

$page_title = 'Login - Flix9 Hub';
$page_css = ['css/pages.css'];
include 'includes/header.php';

// Get messages from session
$errors = $_SESSION['login_errors'] ?? [];
$info_message = $_SESSION['login_info'] ?? '';

// Clear session variables
unset($_SESSION['login_errors']);
unset($_SESSION['login_info']);
?>

    <main class="page-content">
        <section class="login-section">
            <h2>Login to Your Account</h2>

            <?php if (!empty($errors)): ?>
                <div class="form-errors">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ($info_message): ?>
                <div class="form-success" style="background-color: #17a2b8; color: white; padding: 1rem; margin-bottom: 1rem; border-radius: 5px;">
                    <p><?php echo htmlspecialchars($info_message); ?></p>
                </div>
            <?php endif; ?>

            <form action="login_handler.php" method="POST" class="contact-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            <p class="auth-switch">Don't have an account? <a href="register.php">Register here</a></p>
        </section>
    </main>

<?php include 'includes/footer.php'; ?>
