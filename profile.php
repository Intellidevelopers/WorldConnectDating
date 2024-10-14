<?php
// Start the session at the beginning of the file
session_start();

// Include your database connection file
include('dbconn.php');

// Check if 'user_id' is set in $_SESSION
if (!isset($_SESSION['user_id'])) {
    // Redirect or display a message for unauthenticated users
    header("Location: login.php");
    exit; // Stop further execution
}

// Get the logged-in user ID from the session
$user_id = $_SESSION['user_id'];

?>


<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from datingkit.w3itexpert.com/xhtml/profile.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 19 Oct 2023 01:39:55 GMT -->
<head>
	
	<!-- Title -->
	<title>WorldConnect - Dating Forum</title>

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

	<!-- Favicons Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">
	
    
    <!-- Global CSS -->
	<link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
	<link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
    
	<!-- Stylesheets -->
    <link rel="stylesheet" class="main-css" type="text/css" href="assets/css/style.css">
	
    <!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&amp;family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

	<style>
		.photo-box {
			overflow: hidden;
            border-radius: 6px;
            background-size: cover;
            background-position: center;
            transition: transform 0.3s ease-in-out;
            cursor: pointer;
		}
		.img{
			width: 400px;
			border-radius: 300px;
			height: 50px;
		}
		.name{
			margin-bottom: -20px
		}
	</style>
</head>   
<body class="header-large">
<div class="page-wrapper">
    
	<!-- Preloader -->
	<div id="preloader">
		<div class="loader">
			<div class="load-circle"><div></div><div></div></div>
		</div>
	</div>
    <!-- Preloader end-->
	
	<!-- Header -->
		<header class="header header-fixed bg-white border-0">
			<div class="container">
				<div class="header-content">
					<div class="left-content me-3">
						<a href="javascript:void(0);" class="back-btn">
							<i class="icon feather icon-chevron-left"></i>
						</a>
						<h6 class="title">Profile</h6>
					</div>
					<div class="mid-content">
					</div>
					<div class="right-content dz-meta">
						<a href="filter.html" class="filter-icon">
							<i class="flaticon flaticon-settings-sliders"></i>
						</a>
					</div>
				</div>
			</div>
		</header>
	<!-- Header -->
	<?php

// Check if 'user_id' is set in $_SESSION
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Function to get user details by ID from the database
    function getUserById($conn, $userId) {
        $user = null;

        // Prepare and execute query to fetch user by ID using a prepared statement
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $userId);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
            }

            mysqli_stmt_close($stmt);
        }

        return $user;
    }

    // Get user details by ID
    $user = getUserById($conn, $userId);

    // Check if user exists and display user information
    if ($user) {
        // Display user profile information within HTML structure
        ?>
	<!-- Page Content Start -->
	<div class="page-content space-top p-b60">
		<div class="container pt-0"> 
			<div class="profile-area">
				<div class="main-profile">
					<div class="about-profile">
						<a href="setting.html" class="setting dz-icon">
							<i class="flaticon flaticon-setting"></i>
						</a>
						<div class="media">
							<img src="<?= $user['profilepic']; ?>" alt="profile-image" class="img">
						</div>
						<a href="edit-profile.php" class="edit-profile dz-icon">
							<i class="flaticon flaticon-pencil-2"></i>
						</a>
					</div>
					<div class="profile-detail">
						<h5 class="name"><?= $user['first_name']; ?>, <?= $user['dob']; ?></h5>
						<p class="mb-0 " id="location"></p>
					</div>
				</div>
				<div class="row g-2 mb-5">
					<div class="col-4">
						<div class="card style-2">
							<div class="card-body">
								<a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">	
									<div class="card-icon">
										<i class="flaticon flaticon-star-1"></i>
									</div>
									<div class="card-content">
										<p>0 Super Likes</p>
									</div>
									<i class="icon feather icon-plus"></i>
								</a>
							</div>
						</div>
					</div>
					<div class="col-4">
						<div class="card style-2">
							<div class="card-body">
								<div class="card-icon">
									<i class="flaticon flaticon-shuttle"></i>
								</div>
								<div class="card-content">
									<p>My Boosts</p>
								</div>
								<i class="icon feather icon-plus"></i>
							</div>
						</div>
					</div>
					<div class="col-4">
						<div class="card style-2">
							<div class="card-body">
								<a href="subscription.html">
									<div class="card-icon">
										<i class="flaticon flaticon-bell"></i>
									</div>
									<div class="card-content">
										<p>Subscriptions</p>
									</div>
									<i class="icon feather icon-plus"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="swiper subscription-swiper">
					<div class="swiper-wrapper mb-3">
						<div class="swiper-slide">
							<div class="dz-content">
								<h5 class="title">Get Dating Plus</h5>
								<p>Get Unlimited Likes, Passport and more!</p>
								<a href="subscription.html" class="btn rounded-xl">Get Dating Plus</a>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="dz-content">
								<h5 class="title">Get Dating Gold</h5>
								<p>Get Unlimited Likes, Passport and more!</p>
								<a href="subscription.html" class="btn rounded-xl">Get Dating Gold</a>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="dz-content">
								<h5 class="title">Get Dating Platinum</h5>
								<p>Get Unlimited Likes, Passport and more!</p>
								<a href="subscription.html" class="btn rounded-xl">Get Dating Platinum</a>
							</div>
						</div>
					</div>
					<div class="swiper-btn">
						<div class="swiper-pagination style-1 flex-1"></div>
					</div>
				</div>

				<div class="profile-photos">
					<div class="row g-3">
                            <div class="col-4">
                                <div class="photo-box">
                                    <img src="<?= $user['profilepic']; ?>" width="200" alt="photo">
                                </div>
                            </div>
					</div>    
				</div>
			</div>
		</div>
	</div>
	<!-- Page Content End -->
	<?php
    } else {
        echo "<p>User not found</p>";
    }
} else {
    // Redirect or display a message for unauthenticated users
    header("Location: login.php");
    exit; // Stop further execution
}

mysqli_close($conn); // Close database connection
?>
	<!-- Like OffCanvas -->
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom">
		<button type="button" class="btn-close drage-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <div class="offcanvas-body p-4">
			<div class="subscription-box">
				<div class="icon-bx dz-flex-box mx-auto mb-3">
					<i class="flaticon flaticon-star-1"></i>
				</div>
				<h6>Stand out with Super Like</h6>
				<p>You're 3x more likely to get a match!</p>
				
				<div class="short-tag" role="group" aria-label="radio toggle button">
					<div class="clearfix">
						<input type="radio" class="btn-check" name="btnradio" id="btnradio1">
						<label class="tag-btn" for="btnradio1">
							<span class="title">3</span>
							<span class="small-text">Super Likes</span>
							<span class="pack font-12 mb-0">296.60/ea</span>
						</label>
					</div>

					<div class="clearfix mid-content">
						<input type="radio" class="btn-check" name="btnradio" id="btnradio2" checked>
						<label class="tag-btn" for="btnradio2">
							<span class="title">15</span>
							<span class="small-text">Super Likes</span>
							<span class="pack font-12 mb-0">296.60/ea</span>
						</label>
					</div>
					
					<div class="clearfix">
						<input type="radio" class="btn-check" name="btnradio" id="btnradio3">
						<label class="tag-btn" for="btnradio3">
							<span class="title">20</span>
							<span class="small-text">Super Likes</span>
							<span class="pack font-12 mb-0">296.60/ea</span>
						</label>
					</div>
				</div>
				<a href="javascript:void(0);" class="btn btn-gradient w-100 dz-flex-box btn-shadow rounded-xl" data-bs-dismiss="offcanvas" aria-label="Close">GET SUPER LINKS</a>
			</div>
		</div>
    </div>
	<!-- Like OffCanvas -->
	
	<!-- Menubar -->
	<div class="menubar-area footer-fixed">
		<div class="toolbar-inner menubar-nav">
			<a href="home.php?user_id=<?php echo $user_id; ?>" class="nav-link">
				<i class="flaticon flaticon-dog-house"></i>
			</a>
			<a href="explore.html" class="nav-link">
				<i class="flaticon flaticon-search"></i>
			</a>
			<a href="wishlist.html" class="nav-link">
				<i class="flaticon flaticon-heart"></i>
			</a>
			<a href="chat-list.html" class="nav-link">
				<i class="flaticon flaticon-chat-1"></i>
			</a>
			<a href="profile.php" class="nav-link active">
				<i class="flaticon flaticon-user"></i>
			</a>
		</div>
	</div>
	<!-- Menubar -->
</div>  
<!--**********************************
    Scripts
***********************************-->
<script src="assets/js/jquery.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script><!-- Swiper -->
<script src="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script><!-- Swiper -->
<script src="assets/js/dz.carousel.js"></script><!-- Swiper -->
<script src="assets/js/settings.js"></script>
<script src="assets/js/custom.js"></script>
</body>
<script>
    // Automatically get the user's location when the page loads
    window.onload = function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            document.getElementById('location').innerText = "Geolocation is not supported by this browser.";
        }
    };

    function showPosition(position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;
        // Optionally, you can reverse geocode using a free API (e.g., OpenCageData)
        reverseGeocode(lat, lon);
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                document.getElementById('location').innerText = "User denied the request for Geolocation.";
                break;
            case error.POSITION_UNAVAILABLE:
                document.getElementById('location').innerText = "Location information is unavailable.";
                break;
            case error.TIMEOUT:
                document.getElementById('location').innerText = "The request to get user location timed out.";
                break;
            case error.UNKNOWN_ERROR:
                document.getElementById('location').innerText = "An unknown error occurred.";
                break;
        }
    }

    function reverseGeocode(lat, lon) {
        const apiKey = 'ecf02c517f714576bf138abddb097dcb'; // Replace with your OpenCage API key
        const url = `https://api.opencagedata.com/geocode/v1/json?q=${lat}+${lon}&key=${apiKey}`;
        
        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.results && data.results.length > 0) {
                    const { city, state } = data.results[0].components;
                    document.getElementById('location').innerText += `\n${city} ${state}`;
                } else {
                    document.getElementById('location').innerText += `\nCity/State not found.`;
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
<!-- Mirrored from datingkit.w3itexpert.com/xhtml/profile.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 19 Oct 2023 01:39:55 GMT -->
</html>