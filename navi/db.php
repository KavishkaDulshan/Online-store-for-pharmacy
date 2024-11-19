<?php
// db.php

$host = 'localhost'; // Your database host (usually 'localhost')
$db = 'pharmacy_data'; // Database name
$user = 'root'; // Your database username
$pass = ''; // Your database password (empty if you're using default local setup)

// Set up DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db;charset=utf8";

// Set PDO options
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    // Create a PDO instance
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // Handle connection errors
    die("Connection failed: " . $e->getMessage());
}
?>
