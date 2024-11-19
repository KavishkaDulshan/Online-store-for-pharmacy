<?php
// login.php

require 'db.php';  // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a SQL query to retrieve the user's password from the database based on the email
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if a user is found and verify the password
    if ($user) {
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id']; // Store the user ID in the session
            $_SESSION['username'] = $username; // Store the username in the session
            header("Location: home2.html"); // Redirect to a dashboard or home page
            exit();
        } else {
            echo "Error: Incorrect password.";
        }
    } else {
        echo "Error: No user found with that email.";
    }
}
?>