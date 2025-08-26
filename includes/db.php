<?php
$host = 'localhost';
$dbname = 'u191663925_flix9hub';
$username = 'u191663925_flix9hub';
$password = 'Kalachand@1974';
$charset = 'utf8mb4';

// In a real production environment, you should use environment variables
// for these credentials instead of hardcoding them.

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
    // In a real app, log this error and show a generic friendly message
    // For now, we'll just kill the script and show the error.
    error_log($e->getMessage());
    die("Database connection failed. Please check your configuration.");
}
?>
