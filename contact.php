<?php
$page_title = 'Contact Us - Flix9 Hub';
$page_css = ['css/pages.css'];
include 'includes/header.php';
?>

    <main class="page-content">
        <section class="contact-section">
            <h2>Contact Us</h2>
            <p>Have a question or want to get in touch? Fill out the form below and we'll get back to you as soon as possible.</p>
            <form action="contact_handler.php" method="POST" class="contact-form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="6" required></textarea>
                </div>
                <button type="submit" class="btn">Send Message</button>
            </form>
        </section>
    </main>

<?php include 'includes/footer.php'; ?>
