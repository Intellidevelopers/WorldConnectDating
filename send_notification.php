<?php
// Include your database connection file
include('dbconn.php');

// Check if necessary parameters are provided
if (isset($_POST['receiver_id'], $_POST['sender_id'], $_POST['type'])) {
    // Sanitize inputs to prevent SQL injection or XSS
    $receiver_id = filter_var($_POST['receiver_id'], FILTER_SANITIZE_NUMBER_INT);
    $sender_id = filter_var($_POST['sender_id'], FILTER_SANITIZE_NUMBER_INT);
    $type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);

    // Predefined valid notification types
    $valid_types = ['like', 'love', 'view'];

    // Validate notification type
    if (!in_array($type, $valid_types)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid notification type']);
        exit();
    }

    // Check if both sender and receiver IDs are valid users (pseudo code for illustration)
    $user_check_query = "SELECT COUNT(*) FROM users WHERE id = ?";
    $stmt = $conn->prepare($user_check_query);
    
    // Check receiver
    $stmt->bind_param('i', $receiver_id);
    $stmt->execute();
    $stmt->bind_result($receiver_exists);
    $stmt->fetch();
    
    if ($receiver_exists == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Receiver not found']);
        exit();
    }

    // Check sender
    $stmt->bind_param('i', $sender_id);
    $stmt->execute();
    $stmt->bind_result($sender_exists);
    $stmt->fetch();

    if ($sender_exists == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Sender not found']);
        exit();
    }
    
    // Close the user check statement
    $stmt->close();

    // Prepare the message based on notification type
    $message = '';
    $notification_type_message = '';
    
    if ($type === 'like') {
        $message = 'liked your profile.';
        $notification_type_message = 'Profile liked';
    } elseif ($type === 'love') {
        $message = 'loved your profile.';
        $notification_type_message = 'Profile loved';
    } elseif ($type === 'view') {
        $message = 'viewed your profile.';
        $notification_type_message = 'Profile viewed';  // Store "Profile viewed" in notification_type column
    }

    // Insert the notification into the database
    $query = "INSERT INTO notifications (receiver_id, sender_id, notification_type, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iiss', $receiver_id, $sender_id, $notification_type_message, $message);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Notification stored successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error storing notification']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
