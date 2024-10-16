<?php
// Assume a database connection is established
require('dbconn.php');

// Get the viewed_user_id and current_user_id from POST data
$viewed_user_id = $_POST['viewed_user_id'];
$current_user_id = $_POST['current_user_id'];

// Fetch the viewed user's profile from the database
// Make sure to exclude the current user details
$query = "SELECT first_name, dob, status, profilepic FROM users WHERE id = ? AND id != ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $viewed_user_id, $current_user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the profile data
    $profile = $result->fetch_assoc();

    // Send back the profile data in JSON format
    echo json_encode($profile);
} else {
    // Handle case where no profile is found (e.g., wrong ID)
    echo json_encode(["error" => "User profile not found"]);
}
?>
