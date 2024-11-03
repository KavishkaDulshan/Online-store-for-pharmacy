<?php
// db.php

$host = 'localhost'; // Your database host
$db = 'health_bridge'; // Your database name
$user = 'root'; // Default username for XAMPP
$pass = ''; // Default password for XAMPP (usually empty)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
