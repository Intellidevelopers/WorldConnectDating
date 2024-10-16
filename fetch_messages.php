<?php
require('dbconn.php');
// Fetch messages
$sql = "SELECT receiver_id, message, timestamp FROM messages ORDER BY timestamp DESC";
$result = $conn->query($sql);

$messages = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}
$conn->close();

// Return messages as JSON
header('Content-Type: application/json');
echo json_encode($messages);
?>
