<?php
// Start the session
session_start();

// Include your database connection file
include('dbconn.php');

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Get the logged-in user ID from the session
    $logged_in_user_id = $_SESSION['user_id'];

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
	<meta name="theme-color" content="#FF50A2">
	<meta name="author" content="WorldConnect">
	<meta name="robots" content="index, follow"> 
	<meta name="keywords" content="android, ios, mobile, application template, progressive web app, ui kit, multiple color, dark layout, match, partner, perfect match, dating app, dating, couples, dating kit, mobile app">
	<meta name="description" content="Transform your dating app vision into reality with our 'Dating Kit' - a powerful Bootstrap template for mobile dating applications. Seamlessly integrate captivating features, stylish UI components, and user-friendly functionality. Launch your dating app efficiently and elegantly using the Dating Kit template.">
	<meta property="og:title" content="WorldConnect - Dating Forum">
	<meta property="og:description" content="Transform your dating app vision into reality with our 'Dating Kit' - a powerful Bootstrap template for mobile dating applications. Seamlessly integrate captivating features, stylish UI components, and user-friendly functionality. Launch your dating app efficiently and elegantly using the Dating Kit template.">
	<meta property="og:image" content="https://datingkit.WorldConnect.com/xhtml/error.html">
	<meta name="format-detection" content="telephone=no">
    <title>Notifications</title>
    <!-- Bootstrap CSS (or you can add your own custom CSS) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .notification-item {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .notification-item p {
            margin: 0;
        }
        .notification-item .text-muted {
            font-size: 0.9em;
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
                    <p><strong><?php echo htmlspecialchars($row['first_name']); ?></strong> <h6 style="color: #FF50A2"><?php echo htmlspecialchars($row['message']); ?></h6></p>
                    <p class="text-muted"><?php echo htmlspecialchars($row['created_at']); ?></p>
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

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
