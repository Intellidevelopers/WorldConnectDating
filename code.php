<?php
include('dbconn.php');
session_start();

if (isset($_POST["submit"])) {
    // Retrieve posted form data
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $interest = $_POST['interest'];
    $sexual_orientation = $_POST['sexual_orientation'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];
    $kids_ages = $_POST['kids_ages'];
    $education = $_POST['education'];
    $work_experience = $_POST['work_experience'];
    $occupation = $_POST['occupation'];
    $company = $_POST['company'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $about = $_POST['about'];

    $errors = [];

    // Validation
    if (empty($email) || empty($password) || empty($passwordRepeat) || empty($first_name) || empty($dob) || empty($about)) {
        $errors[] = "All required fields must be filled.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }
    if ($password !== $passwordRepeat) {
        $errors[] = "Passwords do not match.";
    }

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            $errors[] = "Email already exists.";
        }
    } else {
        $errors[] = "Database error.";
    }

    // Handle profile picture upload
    $targetDir = "uploads/";
    $allowedFileTypes = ['jpg', 'jpeg', 'png', 'gif'];
    $profilepicPath = '';
    $imagePath = '';

    // Handle profile picture upload
    if (isset($_FILES['profilepic']) && $_FILES['profilepic']['error'] == 0) {
        $profilepic = $_FILES['profilepic'];
        $profilepicName = basename($profilepic['name']);
        $fileExtension = strtolower(pathinfo($profilepicName, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedFileTypes)) {
            $errors[] = "Only JPG, JPEG, PNG, and GIF files are allowed for the profile picture.";
        } else {
            $profilepicPath = $targetDir . $profilepicName;
            if (!move_uploaded_file($profilepic['tmp_name'], $profilepicPath)) {
                $errors[] = "Failed to upload profile picture.";
            }
        }
    } else {
        $errors[] = "Please upload a profile picture.";
    }

    // Handle additional image upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = $_FILES['photo'];
        $photoName = basename($photo['name']);
        $fileExtension = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedFileTypes)) {
            $errors[] = "Only JPG, JPEG, PNG, and GIF files are allowed for the additional photo.";
        } else {
            $photoPath = $targetDir . $photoName;
            if (!move_uploaded_file($photo['tmp_name'], $photoPath)) {
                $errors[] = "Failed to upload additional photo.";
            }
        }
    } else {
        $errors[] = "Please upload an additional photo.";
    }

    if (empty($errors)) {
        // Hash the password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into users table
        $sql = "INSERT INTO users (email, password, first_name, dob, gender, sexual_orientation, kids_ages, interest, profilepic, photo, education, work_experience, occupation, company, start_date, end_date, about) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssssssssssssss",
                $email,
                $passwordHash,
                $first_name,
                $dob,
                $gender,
                $sexual_orientation,
                $kids_ages,
                $interest,
                $profilepicPath,
                $photoPath,
                $education,
                $work_experience,
                $occupation,
                $company,
                $start_date,
                $end_date,
                $about
            );

            if (mysqli_stmt_execute($stmt)) {
                $user_id = mysqli_insert_id($conn); // Get the last inserted user ID
                $_SESSION['user_id'] = $user_id; // Store the user ID in session
                $_SESSION['email'] = $email;
                header("Location: home.php?user_id=$user_id");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Database error: " . mysqli_error($conn) . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Database error during registration.</div>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }

    mysqli_close($conn);
}
?>
