<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first-name'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone-number'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $birthDate = $_POST['birth-date'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO users (firstName, lastName, email, phone, password, birthDate, gender) 
            VALUES ('$firstName', '$lastName', '$email', '$phone', '$password', '$birthDate', '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "User registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register form</title>
    <style>
        body 
        {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-image: url('pharmacy.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }
        .form-container {
            background-color: #935bfa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group input[type="submit"] {
            background-color: #3c2cee;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        .form-group input[type="submit"]:hover {
            background-color: #2f0364;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Create a new account</h2>
    <form action="#" method="post">
        <div class="form-group">
            <label for="first-name">First Name</label>
            <input type="text" id="first-name" name="first-name" placeholder="Enter your first name" required>
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" id="lastname" name="lastname" placeholder="Enter your last name" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter email address" required>
        </div>
        <div class="form-group">
            <label for="phone-number">Phone Number</label>
            <input type="text" id="phone-number" name="phone-number" placeholder="Enter phone-number" required>
        </div>
        <div class="form-group">
            <label for="new-password">New Password</label>
            <input type="password" id="new-password" name="new-password" placeholder="create a new password" required>
        </div>
        <div class="form-group">
            <label for="conform-password">Conform Password</label>
            <input type="password" id="conform-password" name="conform-password" placeholder="conform your password" required>
        </div>
        <div class="form-group">
            <label for="birthdate">Birth Date</label>
            <input type="date" id="birthdate" name="birthdate" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select id="gender" name="gender" required>
                <option value="">Select your gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Submit">
            

        </div>
    </form>
</div>

</body>
</html>