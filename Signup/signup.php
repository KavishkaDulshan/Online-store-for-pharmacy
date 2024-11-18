<?php
// Start the session
session_start();

// Database connection parameters
$host = 'localhost'; // Database host
$dbname = 'admin_panel'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password (use your actual password)

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input
    $firstName = filter_input(INPUT_POST, 'first-name', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'last-name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phoneNumber = filter_input(INPUT_POST, 'phone-number', FILTER_SANITIZE_STRING);
    $password = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-password'];
    $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);

    // Validate password
    if ($password !== $confirmPassword) {
        $error_message = "Passwords do not match.";
        header("Location: signup.html?error=" . urlencode($error_message));
        exit;
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare an SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone_number, password, birthdate, gender) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $firstName, $lastName, $email, $phoneNumber, $hashedPassword, $birthdate, $gender);

    // Execute the statement
    if ($stmt->execute()) {
        // Successful registration, you can redirect or set a success message
        $_SESSION['message'] = "Registration successful! You can now log in.";
        header("Location: login.php");
        exit;
    } else {
        // Registration failed
        $error_message = "Registration failed. Please try again.";
        header("Location: signup.html?error=" . urlencode($error_message));
        exit;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
