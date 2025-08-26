<?php
$page_title = 'Login - Flix9 Hub';
$page_css = ['css/pages.css'];
include 'includes/header.php';
?>

    <main class="page-content">
        <section class="login-section">
            <h2>Login to Your Account</h2>
            <form action="login_handler.php" method="POST" class="contact-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
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
