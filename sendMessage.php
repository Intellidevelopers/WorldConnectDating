<?php
session_start();
include 'dbconn.php'; // Include your database connection

$sender_id = $_SESSION['user_id']; // The logged-in user
$receiver_id = $_POST['receiver_id']; // ID of the user receiving the message
$message = $_POST['message'];

if (!empty($message) && !empty($receiver_id)) {
    $sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $sender_id, $receiver_id, $message);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Message sent!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to send message."]);
    }
    $stmt->close();
}
$conn->close();
?>
