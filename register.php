<?php
$page_title = 'Register - Flix9 Hub';
$page_css = ['css/pages.css'];
include 'includes/header.php';
?>

    <main class="page-content">
        <section class="register-section">
            <h2>Create Your Investor Account</h2>
            <form action="register_handler.php" method="POST" class="contact-form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" name="fullname" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="address">Contact Address</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" required>
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" id="state" name="state" required>
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" id="country" name="country" required>
                </div>
                <div class="form-group">
                    <label>National ID (Front and Back) or Passport</label>
                    <p style="font-size: 0.9rem; color: #ccc;">Please upload clear images.</p>
                    <label for="id_front">ID Front / Passport</label>
                    <input type="file" id="id_front" name="id_front" accept="image/*" required>
                    <label for="id_back" style="margin-top: 10px;">ID Back (if applicable)</label>
                    <input type="file" id="id_back" name="id_back" accept="image/*">
                </div>
                <button type="submit" class="btn">Register</button>
            </form>
            <p class="auth-switch">Already have an account? <a href="login.php">Login here</a></p>
        </section>
    </main>

<?php include 'includes/footer.php'; ?>
