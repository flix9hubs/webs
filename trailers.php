<?php
session_start();
$page_title = 'Latest Movies - Flix9 Hub'; // Changed title to reflect posters
$page_css = ['css/pages.css'];
include 'includes/header.php';
require 'includes/data.php'; // Include the dummy data
?>

    <main class="page-content">
        <section class="trailers-section">
            <h2>Latest Movies</h2>
            <div class="trailer-grid">

                <?php if (empty($latest_trailers)): ?>
                    <p>No new movies are available at the moment.</p>
                <?php else: ?>
                    <?php foreach ($latest_trailers as $trailer): ?>
                        <div class="trailer-item">
                            <img src="<?php echo htmlspecialchars($trailer['poster_path']); ?>" alt="<?php echo htmlspecialchars($trailer['title']); ?> Poster" style="width:100%; border-radius: 5px;">
                            <div class="investment-snippet">
                                <p><?php echo htmlspecialchars($trailer['snippet']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </section>
    </main>

<?php include 'includes/footer.php'; ?>
