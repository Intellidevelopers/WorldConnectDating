<?php
session_start();
include 'dbconn.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database to check the email and password
    $sql = "SELECT id, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
         // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set the session with the user ID
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['loggedin'] = true;
            
            // Redirect to home page with user ID passed in session
            header("Location: home.php");
            exit();
        } else {
            // Invalid password
            echo "Invalid email or password.";
        }
    } else {
        // User not found
        echo "User not found.";
    }
}
?>
