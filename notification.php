<?php
// Start the session
session_start();

// Include your database connection file
include('dbconn.php');

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Get the logged-in user ID from the session
    $logged_in_user_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch notifications for the logged-in user
    $query = "SELECT n.sender_id, u.first_name, n.notification_type, n.message, n.created_at 
              FROM notifications n 
              JOIN users u ON n.sender_id = u.id 
              WHERE n.receiver_id = ? 
              ORDER BY n.created_at DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $logged_in_user_id);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Redirect to login page if the user is not logged in
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#FF50A2">
    <meta name="description" content="Dating app notifications page">
    <title>Notifications</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .notification-item {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .notification-item p {
            margin: 0;
        }
        .notification-item .text-muted {
            font-size: 0.85em;
            color: #6c757d;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2>Notifications</h2>
    <div class="list-group">
        <?php
        // Display notifications
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="notification-item">
                    <p><strong><?php echo htmlspecialchars($row['first_name']); ?></strong></p>
                    <h6 style="color: #FF50A2"><?php echo htmlspecialchars($row['message']); ?></h6>
                    <p class="text-muted"><?php echo htmlspecialchars(date('M d, Y H:i', strtotime($row['created_at']))); ?></p>
                </div>
                <?php
            }
        } else {
            echo "<p>No notifications found</p>";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
        ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
