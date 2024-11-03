<?php
// signup.php

require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first-name'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phone-number'];
    $password = $_POST['new-password'];
    $confirmPassword = $_POST['conform-password'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];

    if ($password !== $confirmPassword) {
        echo "Error: Passwords do not match.";
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, phone_number, password, birthdate, gender) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $success = $stmt->execute([$firstName, $lastName, $email, $phoneNumber, $hashedPassword, $birthdate, $gender]);

    if ($success) {
        echo "Registration successful!";
    } else {
        echo "Error: Could not register user.";
    }
}
?>
