<?php
session_start();
$page_title = 'Upcoming Investments - Flix9 Hub';
$page_css = ['css/pages.css'];
include 'includes/header.php';
require 'includes/data.php'; // Include the dummy data
?>

    <main class="page-content">
        <section class="investments-section">
            <h2>Upcoming Projects for Investment</h2>
            <div class="trailer-grid">

                <?php if (empty($upcoming_projects)): ?>
                    <p>There are no upcoming projects available for investment at the moment. Please check back later.</p>
                <?php else: ?>
                    <?php foreach ($upcoming_projects as $project): ?>
                        <div class="trailer-item">
                            <video controls width="100%" poster="images/poster_placeholder.jpg">
                                <source src="<?php echo htmlspecialchars($project['video_path']); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="investment-snippet">
                                <p><?php echo htmlspecialchars($project['hot_deal_snippet']); ?></p>
                            </div>
                            <div class="investment-description">
                                <p><strong>🎥 Title:</strong> <?php echo htmlspecialchars($project['title']); ?><br>
                                   <strong>🌟 Cast:</strong> <?php echo htmlspecialchars($project['cast']); ?><br>
                                   <strong>📺 OTT Rights | Tamil Language</strong></p>
                                <ul>
                                    <li><strong>💰 Earn <?php echo htmlspecialchars($project['returns']); ?> Returns Every Month</strong></li>
                                    <li><strong>⏳ Tenure:</strong> <?php echo htmlspecialchars($project['tenure']); ?></li>
                                    <li><strong>💵 Minimum Investment:</strong> <?php echo htmlspecialchars($project['min_investment']); ?></li>
                                    <li><strong>⚙️ Asset Management Fee:</strong> <?php echo htmlspecialchars($project['asset_fee']); ?></li>
                                </ul>
                                <p class="investment-cta">
                                    <strong>🎯 A perfect short-term, high-potential OTT investment!</strong><br>
                                    <strong>🚀 Seats are filling fast – Secure your ticket today!</strong>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </section>
    </main>

<?php include 'includes/footer.php'; ?>
