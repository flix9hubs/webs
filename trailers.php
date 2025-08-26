<?php
$page_title = 'Trailers - Flix9 Hub';
$page_css = ['css/pages.css'];
include 'includes/header.php';
?>

    <main class="page-content">
        <section class="trailers-section">
            <h2>Latest Trailers</h2>
            <div class="trailer-grid">
                <!-- Trailer 1 -->
                <div class="trailer-item">
                    <video controls width="100%">
                        <!-- I will use a placeholder source, as I don't have video files -->
                        <source src="videos/trailer1.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="investment-snippet">
                        <p><strong>Invested Amount:</strong> ₹XX,XX,XXX | <strong>Collected Amount:</strong> ₹YY,YY,YYY</p>
                        <p>🎬 Hot Deal from Velan Productions (WEB) 🔥 Limited Ticket Size – Grab Yours Before It’s Gone!</p>
                    </div>
                </div>

                <!-- Trailer 2 -->
                <div class="trailer-item">
                    <video controls width="100%">
                        <source src="videos/trailer2.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="investment-snippet">
                        <p><strong>Invested Amount:</strong> ₹AA,AA,AAA | <strong>Collected Amount:</strong> ₹BB,BB,BBB</p>
                        <p>🎬 Hot Deal from Velan Productions (WEB) 🔥 Limited Ticket Size – Grab Yours Before It’s Gone!</p>
                    </div>
                </div>

                <!-- Add more trailers as needed -->

            </div>
        </section>
    </main>

<?php include 'includes/footer.php'; ?>
