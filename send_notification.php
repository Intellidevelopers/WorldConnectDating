<?php
// Include your database connection file
include('dbconn.php');

// Check if necessary parameters are provided
if (isset($_POST['receiver_id'], $_POST['sender_id'], $_POST['type'])) {
    $receiver_id = $_POST['receiver_id'];
    $sender_id = $_POST['sender_id'];
    $type = $_POST['type'];

    // Prepare the message for the notification
    $message = ($type === 'like') ? 'liked your profile.' : 'loved your profile.';

    // Insert the notification into the database
    $query = "INSERT INTO notifications (receiver_id, sender_id, notification_type, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iiss', $receiver_id, $sender_id, $type, $message);

    if ($stmt->execute()) {
        echo 'Notification stored successfully';
    } else {
        echo 'Error storing notification';
    }

    // Close the prepared statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo 'Invalid request';
}
?>
