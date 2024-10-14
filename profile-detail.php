<?php
// Include configuration file
include('dbconn.php');
// Start the session
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Get the logged-in user ID from the session
$user_id = $_SESSION['user_id'];
// Fetch user details from the database
$sql = "SELECT first_name, dob, interest, profilepic,education, work_experience,sexual_orientation, about, company, occupation, kids_ages FROM users WHERE id = ?";
$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
} else {
    // Handle database error
    echo "<div class='alert alert-danger'>Database error.</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
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
	
	<!-- PWA Version -->
	<link rel="manifest" href="manifest.json">
    
    <!-- Global CSS -->
	<link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/nouislider/nouislider.min.css">
	<link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
    
	<!-- Stylesheets -->
    <link rel="stylesheet" class="main-css" type="text/css" href="assets/css/style.css">
	
    <!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&amp;family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

	<style>
		.flex{
			display: flex;
			align-items: center;
			justify-content: space-between;
		}
		.title2{
			margin-bottom: -20px
		}
	</style>
</head>   
<body class="bg-white">
<div class="page-wrapper">
    
	<!-- Preloader -->
	<div id="preloader">
		<div class="loader">
			<div class="load-circle"><div></div><div></div></div>
		</div>
	</div>
    <!-- Preloader end-->
	
	<!-- Header -->
		<header class="header header-fixed bg-white">
			<div class="container">
				<div class="header-content">
					<div class="left-content">
						<a href="javascript:void(0);" class="back-btn">
							<i class="icon feather icon-chevron-left"></i>
						</a>
						<h6 class="title">Recommendation</h6>
					</div>
					<div class="mid-content header-logo">
					</div>
					<div class="right-content dz-meta">
					</div>
				</div>
			</div>
		</header>
	<!-- Header -->
	
	<!-- Page Content Start -->
	<div class="page-content space-top p-b40">
		<div class="container">
			<div class="detail-area">
				<div class="dz-media-card style-2">
					<div class="dz-media">
						<img src="<?php echo htmlspecialchars($user['profilepic']); ?>" alt="">
					</div>
					<div class="dz-content">
						<div class="left-content">
							<h4 class="title2"><?php echo htmlspecialchars($user['first_name']); ?>, <?php echo htmlspecialchars($user['dob']); ?></h4>
							<p class="mb-0" id="location"><i class="icon feather icon-map-pin"></i></p>
						</div>
						<a href="javascript:void(0);" onclick="alert('You followed this user')" class="dz-icon"><i class="flaticon flaticon-star-1"></i></a>
					</div>
				</div>
				<div class="detail-bottom-area">
					<div class="about">
							<h6 class="title">Basic information</h6>
						<p class="para-text"><?php echo htmlspecialchars($user['about']); ?></p>					
					</div>
					<div class="flex">
						<div class="intrests mb-3">
							<h6 class="title">Education</h6>
							<ul class="dz-tag-list">
								<li> 
									<div class="dz-tag">
										<span><?php echo htmlspecialchars($user['education']); ?></span>
									</div>
								</li>
							</ul>
						</div>

						<div class="intrests mb-3">
						<h6 class="title">Occupation</h6>
						<ul class="dz-tag-list">
							<li> 
								<div class="dz-tag">
									<span><?php echo htmlspecialchars($user['occupation']); ?></span>
								</div>
							</li>
						</ul>
					</div>

					<div class="intrests mb-3">
						<h6 class="title">Sexual Orientation</h6>
						<ul class="dz-tag-list">
							<li> 
								<div class="dz-tag">
									<span><?php echo htmlspecialchars($user['sexual_orientation']); ?></span>
								</div>
							</li>
						</ul>
					</div>
					</div>
					<div class="languages mb-3">
						<h6 class="title">Comapany</h6>
						<ul class="dz-tag-list">
							<li> 
								<div class="dz-tag">
									<span><?php echo htmlspecialchars($user['company']); ?></span>
								</div>
							</li>
						</ul>
					</div>
					<div class="languages mb-3">
						<h6 class="title">Kids Ages</h6>
						<ul class="dz-tag-list">
							<li> 
								<div class="dz-tag">
									<span><?php echo htmlspecialchars($user['kids_ages']); ?></span>
								</div>
							</li>
						</ul>
					</div>
					<div class="languages mb-3"></div>
						<h6 class="title">Looking for?</h6>
						<ul class="dz-tag-list">
							<li> 
								<div class="dz-tag">
									<span><?php echo htmlspecialchars($user['interest']); ?></span>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page Content End -->
	<!-- Menubar -->
	<div class="footer fixed">
		<div class="dz-icon-box">
			<a href="home.php" title="Not Interested" onclick="alert('You are not interested in this user')" class="icon dz-flex-box dislike"><i class="flaticon flaticon-cross font-18"></i></a>
			<a href="chat.html" title="Message user" class="icon dz-flex-box super-like"><i class="fa-solid fa-message"></i></a>
			<a href="wishlist.html" title="Interested" onclick="alert('You are interested in this user')" class="icon dz-flex-box like"><i class="fa-solid fa-heart"></i></a>
		</div>
	</div>
	<!-- Menubar -->
</div>  
<!--**********************************
    Scripts
***********************************-->
<script src="assets/js/jquery.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/wnumb/wNumb.js"></script><!-- WNUMB -->
<script src="assets/vendor/nouislider/nouislider.min.js"></script><!-- NOUSLIDER MIN JS-->
<script src="assets/js/settings.js"></script>
<script src="assets/js/custom.js"></script>
<script src="index.js"></script>
<script src="location.js"></script>
</body>

<!-- Mirrored from datingkit.w3itexpert.com/xhtml/profile-detail.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 19 Oct 2023 01:40:18 GMT -->
</html>