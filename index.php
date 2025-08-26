<?php
session_start();
$page_title = 'Flix9 Hub - Invest in Cinema';
$body_class = 'homepage';
include 'includes/header.php';
?>

    <main>
        <section class="homepage">
            <div class="main-quote">
                <h1>Turn your passion for cinema into profits — invest in the magic of movies. 🎥💙</h1>
            </div>
            <div class="carousel-container">
                <div class="carousel-track">
                    <div class="slide"><img src="images/poster1.jpg" alt="Movie Poster 1"></div>
                    <div class="slide"><img src="images/poster2.jpg" alt="Movie Poster 2"></div>
                    <div class="slide"><img src="images/poster3.jpg" alt="Movie Poster 3"></div>
                    <div class="slide"><img src="images/poster4.jpg" alt="Movie Poster 4"></div>
                    <div class="slide"><img src="images/poster5.jpg" alt="Movie Poster 5"></div>
                    <!-- Duplicate for seamless scroll -->
                    <div class="slide"><img src="images/poster1.jpg" alt="Movie Poster 1"></div>
                    <div class="slide"><img src="images/poster2.jpg" alt="Movie Poster 2"></div>
                    <div class="slide"><img src="images/poster3.jpg" alt="Movie Poster 3"></div>
                    <div class="slide"><img src="images/poster4.jpg" alt="Movie Poster 4"></div>
                    <div class="slide"><img src="images/poster5.jpg" alt="Movie Poster 5"></div>
                </div>
            </div>
        </section>
    </main>

<?php include 'includes/footer.php'; ?>
