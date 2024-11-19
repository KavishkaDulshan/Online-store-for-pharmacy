<?php
// signup.php

require 'db.php'; // Include the database connection

session_start(); // Start session for storing error/success messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = trim($_POST['first-name']);
    $lastName = trim($_POST['last-name']);
    $email = trim($_POST['email']);
    $phoneNumber = trim($_POST['phone-number']);
    $password = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-password'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: signup.php");
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: signup.php");
        exit();
    }

    // Check if email already exists in the database
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $emailExists = $stmt->fetchColumn();

    if ($emailExists) {
        $_SESSION['error'] = "Email already registered. Please use another email.";
        header("Location: signup.php");
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL query to insert user data into the database
    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, phone_number, password, birthdate, gender) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $success = $stmt->execute([$firstName, $lastName, $email, $phoneNumber, $hashedPassword, $birthdate, $gender]);

    // Check if the registration was successful
    if ($success) {
        $_SESSION['success'] = "Registration successful! Please log in.";
        header("Location: home.html"); // Redirect to login page
        exit();
    } else {
        $_SESSION['error'] = "Error: Could not register user. Please try again.";
        header("Location: signup.php");
        exit();
    }
}
?>
