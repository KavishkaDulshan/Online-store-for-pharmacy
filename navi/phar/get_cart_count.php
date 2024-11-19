<?php
session_start();
include 'db_connection.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT COUNT(*) as count FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$response = array('status' => 'success', 'count' => $row['count']);
echo json_encode($response);

$stmt->close();
$conn->close();
?>