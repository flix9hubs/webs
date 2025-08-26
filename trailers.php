<?php
session_start();
$page_title = 'Trailers - Flix9 Hub';
$page_css = ['css/pages.css'];
include 'includes/header.php';
require 'includes/data.php'; // Include the dummy data
?>

    <main class="page-content">
        <section class="trailers-section">
            <h2>Latest Trailers</h2>
            <div class="trailer-grid">

                <?php if (empty($latest_trailers)): ?>
                    <p>No trailers are available at the moment.</p>
                <?php else: ?>
                    <?php foreach ($latest_trailers as $trailer): ?>
                        <div class="trailer-item">
                            <video controls width="100%" poster="images/poster_placeholder.jpg">
                                <source src="<?php echo htmlspecialchars($trailer['video_path']); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="investment-snippet">
                                <p><strong>Invested Amount:</strong> <?php echo htmlspecialchars($trailer['invested']); ?> | <strong>Collected Amount:</strong> <?php echo htmlspecialchars($trailer['collected']); ?></p>
                                <p><?php echo htmlspecialchars($trailer['snippet']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </section>
    </main>

<?php include 'includes/footer.php'; ?>
