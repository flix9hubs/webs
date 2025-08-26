<?php
session_start();
$page_title = 'Flix9 Hub - Invest in Cinema';
$body_class = 'homepage';
include 'includes/header.php';
require 'includes/data.php'; // Include the dummy data
?>

    <main>
        <section class="homepage">
            <div class="main-quote">
                <h1>Turn your passion for cinema into profits — invest in the magic of movies. 🎥💙</h1>
            </div>
            <div class="carousel-container">
                <div class="carousel-track">
                    <?php
                    // Original posters
                    foreach ($homepage_carousel_posters as $poster_url) {
                        echo '<div class="slide"><img src="' . htmlspecialchars($poster_url) . '" alt="Movie Poster"></div>';
                    }
                    // Duplicate for seamless scroll effect
                    foreach ($homepage_carousel_posters as $poster_url) {
                        echo '<div class="slide"><img src="' . htmlspecialchars($poster_url) . '" alt="Movie Poster"></div>';
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>

<?php include 'includes/footer.php'; ?>
