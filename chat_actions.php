<?php
session_start();
include 'dbconn.php'; // Ensure you have your DB connection file

// Handle sending a message
if (isset($_POST['action']) && $_POST['action'] === 'send_message') {
    $sender_id = $_SESSION['user_id']; // Assuming you store user ID in the session
    $receiver_id = intval($_POST['receiver_id']);
    $message = htmlspecialchars($_POST['message']);
    $timestamp = date("Y-m-d H:i:s");

    // Insert the message into the database
    $sql = "INSERT INTO messages (sender_id, receiver_id, message, timestamp) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $sender_id, $receiver_id, $message, $timestamp);
    $stmt->execute();
    $stmt->close();

    echo json_encode(['status' => 'success']);
    exit();
}

// Handle retrieving messages
if (isset($_GET['receiver_id'])) {
    $receiver_id = intval($_GET['receiver_id']);
    $user_id = $_SESSION['user_id']; // Assuming you store user ID in the session

    // Fetch messages between the users
    $sql = "SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY timestamp ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $user_id, $receiver_id, $receiver_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }

    echo json_encode($messages);
    exit();
}

$conn->close();
?>
