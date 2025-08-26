<?php
// Default values
$page_title = isset($page_title) ? $page_title : 'Flix9 Hub';
$page_css = isset($page_css) ? $page_css : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <link rel="icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
    <?php
    if (!empty($page_css)) {
        foreach ($page_css as $css_file) {
            echo '<link rel="stylesheet" href="' . htmlspecialchars($css_file) . '">';
        }
    }
    ?>
</head>
<body class="<?php echo isset($body_class) ? $body_class : ''; ?>">
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="trailers.php">Trailers</a></li>
                <li><a href="investments.php">Investments</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="login.php">Login / Register</a></li>
            </ul>
        </nav>
        <div class="logo-container">
            <!-- Logo will go here -->
            <img src="images/logo.png" alt="Flix9 Hub Logo" class="logo">
        </div>
    </header>
