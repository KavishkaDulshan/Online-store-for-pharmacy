<?php
session_start();
include 'db_connection.php';

$user_id = $_SESSION['user_id'];

// Check if the user is logged in
if (!isset($user_id)) {
    echo json_encode([]);
    exit();
}

// Fetch cart items for the logged-in user
$stmt = $conn->prepare("SELECT cart.item_id AS id, products.name, products.price, cart.quantity FROM cart JOIN products ON cart.item_id = products.id WHERE cart.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$cart = [];
while ($row = $result->fetch_assoc()) {
    $cart[] = $row;
}

echo json_encode($cart);

$conn->close();
?>