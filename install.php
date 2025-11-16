<?php
// A simple installer script to set up the database tables.

// IMPORTANT: This script should be deleted or protected after installation.
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Flix9 Hub Installer</h1>";

try {
    // We require the db connection file. If it fails, the script will stop.
    require_once 'includes/db.php';
    echo "<p>Database connection successful.</p>";

    // SQL statement to create the users table
    // Using IF NOT EXISTS ensures that we don't get an error if the table already exists.
    $sql = "
    CREATE TABLE IF NOT EXISTS `users` (
      `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      `fullname` VARCHAR(255) NOT NULL,
      `email` VARCHAR(255) NOT NULL UNIQUE,
      `password` VARCHAR(255) NOT NULL,
      `address` TEXT NOT NULL,
      `city` VARCHAR(100) NOT NULL,
      `state` VARCHAR(100) NOT NULL,
      `country` VARCHAR(100) NOT NULL,
      `id_front_path` VARCHAR(255) NOT NULL,
      `id_back_path` VARCHAR(255) DEFAULT NULL,
      `otp` VARCHAR(10) DEFAULT NULL,
      `otp_expires_at` DATETIME DEFAULT NULL,
      `is_verified` TINYINT(1) NOT NULL DEFAULT 0,
      `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";

    // Execute the SQL statement
    $pdo->exec($sql);

    echo "<p><strong>Success:</strong> 'users' table has been created successfully (or already existed).</p>";

    // You can add more table creation statements here in the future.
    // For example, a 'movies' table or 'investments' table.
    /*
    $sql_movies = "...";
    $pdo->exec($sql_movies);
    echo "<p><strong>Success:</strong> 'movies' table created.</p>";
    */

    echo "<h2>Installation Complete!</h2>";
    echo "<p style='color:red;'><strong>IMPORTANT:</strong> Please delete this 'install.php' file from your server for security reasons.</p>";


} catch (PDOException $e) {
    // If we catch an exception, we'll die and show the error.
    die("<p style='color:red;'><strong>ERROR:</strong> Could not execute table creation script. " . $e->getMessage() . "</p>");
} catch (Throwable $e) {
    // Catch other potential errors, like file not found for require_once
    die("<p style='color:red;'><strong>ERROR:</strong> An unexpected error occurred. " . $e->getMessage() . "</p>");
}

?>
