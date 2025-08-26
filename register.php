<?php
session_start();

$page_title = 'Register - Flix9 Hub';
$page_css = ['css/pages.css'];
include 'includes/header.php';

// Get form data and errors from session if they exist
$errors = $_SESSION['form_errors'] ?? [];
$formData = $_SESSION['form_data'] ?? [];

// Clear session variables so they don't persist on refresh
unset($_SESSION['form_errors']);
unset($_SESSION['form_data']);
?>

    <main class="page-content">
        <section class="register-section">
            <h2>Create Your Investor Account</h2>

            <?php if (!empty($errors)): ?>
                <div class="form-errors">
                    <h4>Please fix the following errors:</h4>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="register_handler.php" method="POST" class="contact-form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($formData['fullname'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($formData['email'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="address">Contact Address</label>
                    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($formData['address'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($formData['city'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" id="state" name="state" value="<?php echo htmlspecialchars($formData['state'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($formData['country'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>National ID (Front and Back) or Passport</label>
                    <p style="font-size: 0.9rem; color: #ccc;">Please upload clear images.</p>
                    <label for="id_front">ID Front / Passport</label>
                    <input type="file" id="id_front" name="id_front" accept="image/*,application/pdf" required>
                    <label for="id_back" style="margin-top: 10px;">ID Back (if applicable)</label>
                    <input type="file" id="id_back" name="id_back" accept="image/*,application/pdf">
                </div>
                <button type="submit" class="btn">Register</button>
            </form>
            <p class="auth-switch">Already have an account? <a href="login.php">Login here</a></p>
        </section>
    </main>

<?php include 'includes/footer.php'; ?>
