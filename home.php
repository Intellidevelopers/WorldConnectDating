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
$sql = "SELECT first_name, email, profilepic FROM users WHERE id = ?";
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

// Function to get all users except the logged-in user
function getAllUsers($conn, $logged_in_user_id) {
    $users = [];
    // Fetch users excluding the logged-in user
    $query = "SELECT * FROM users WHERE id != ?"; 
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $logged_in_user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row; // Add each user to the users array
            }
        }
    }

    return $users;
}

// Get all users except the logged-in user
$users = getAllUsers($conn, $user_id);
?>


<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from datingkit.w3itexpert.com/xhtml/home.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 19 Oct 2023 01:39:45 GMT -->
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
		.modal-footer{
			justify-content: space-between;
		}
		.close{
			background: none;
			border: none;
			color: antiquewhite;
		}
		.title{
			margin-bottom: -15px
		}
	</style>
</head>   
<body class="overflow-hidden header-large">
<div class="page-wrapper">
    
	<!-- Preloader -->
	<div id="preloader">
		<div class="loader">
			<div class="load-circle"><div></div><div></div></div>
		</div>
	</div>
    <!-- Preloader end-->
	
	<!-- Header -->
		<header class="header header-fixed border-0">
			<div class="container">
				<div class="header-content">
					<div class="left-content">
						<a href="javascript:void(0);" class="menu-toggler">
							<i class="icon feather icon-grid"></i>
						</a>
					</div>
					<div class="mid-content header-logo">
						<a href="home.php">
							<img src="assets/images/logo.png" alt="">
						</a>
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
	
	<!-- Sidebar -->
    <div class="dark-overlay"></div>
	<div id="sidebar" class="sidebar">
		<div class="inner-sidebar">
			<a href="profile.php?user_id=<?php echo $user_id; ?>" class="author-box">
				<div class="dz-media">
					<img src="<?php echo htmlspecialchars($user['profilepic']); ?>" alt="author-image">
				</div>
				<div class="dz-info">
					<h5 class="name"><?php echo htmlspecialchars($user['first_name']); ?></h5>
					<span><?php echo htmlspecialchars($user['email']); ?></span>
				</div>
			</a>                                                                                                               
			<ul class="nav navbar-nav">	
				<li>
					<a class="nav-link active" href="home.php">
						<span class="dz-icon">
							<i class="icon feather icon-home"></i>
						</span>
						<span>Home</span>
					</a>
				</li>
				<li>
					<a class="nav-link" href="wallet.html">
						<span class="dz-icon">
							<i class="icon feather icon-pocket"></i>
						</span>
						<span>Wallet</span>
					</a>
				</li>
			
				<li>
					<a class="nav-link" href="wishlist.html">
						<span class="dz-icon">
							<i class="icon feather icon-heart"></i>
						</span>
						<span>Wishlist</span>
					</a>
				</li>
				<li>
					<a class="nav-link" href="setting.html">
						<span class="dz-icon">
							<i class="icon feather icon-settings"></i>
						</span>
						<span>Settings</span>
					</a>
				</li>
				<li>
					<a class="nav-link" href="./tap">
						<span class="dz-icon">
							<i class="fa flaticon-star-1"></i>
						</span>
						<span>Tap</span>
					</a>
				</li>
				<li>
					<a class="nav-link" href="media.html">
						<span class="dz-icon">
							<i class="icon feather icon-video"></i>
						</span>
						<span>Reels</span>
					</a>
				</li>
				<li>
					<a class="nav-link" onclick="showConsentModal()" href="javascript:void(0);">
						<span class="dz-icon">
							<i class="icon feather icon-tv"></i>
						</span>
						<span>Go Live</span>
					</a>
				</li>
		
				<li>
					<a class="nav-link" href="notification.php?user_id=<?php echo $user_id; ?>">
						<span class="dz-icon">
							<i class="icon feather icon-bell"></i>
						</span>
						<span>Notifications</span>
					</a>
				</li>
				<li>
					<a class="nav-link" href="menu.html">
						<span class="dz-icon">
							<i class="icon feather icon-menu"></i>
						</span>
						<span>More</span>
					</a>
				</li>

				<li>
					<a class="nav-link" href="logout.php">
						<span class="dz-icon">
							<i class="icon feather icon-log-out"></i>
						</span>
						<span>Logout</span>
					</a>
				</li>
			</ul>
			<div class="sidebar-bottom">
				<ul class="app-setting">
					<li>
						<div class="mode">
							<span class="dz-icon">                        
								<i class="icon feather icon-moon"></i>
							</span>					
							<span>Dark Mode</span>
							<div class="custom-switch">
								<input type="checkbox" class="switch-input theme-btn" id="toggle-dark-menu">
								<label class="custom-switch-label" for="toggle-dark-menu"></label>
							</div>					
						</div>
					</li>
				</ul>
				<div class="app-info">
					<h6 class="name">WorldConnect - Dating App</h6>
					<span class="ver-info">App Version 1.0</span>
				</div>
			</div>
		</div>
	</div>
    <!-- Sidebar End -->

		<!-- Consent Modal -->
	<div id="consentModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title">Go Live Consent</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<div class="modal-body text-center">
			<img src="assets/images/logo.png" alt="Consent Icon" class="img-fluid mb-3" style="width: 80px;">
			<p>Do you consent to start a live stream?</p>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			<a href="live.html">
			<button type="button" class="btn btn-primary">Yes, Go Live</button>
			</a>
			</div>
		</div>
		</div>
	</div>
	
	<!-- Page Content Start -->
	<div class="page-content space-top p-b65">
		<div class="container">
			<div class="demo__card-cont dz-gallery-slider">
			<?php
            // Check if users exist and display user information
            if (!empty($users)) {
                foreach ($users as $user) {
                    // Display user profile information within HTML structure
            ?>
        <div class="demo__card">
            <div class="dz-media">
                <img src="<?php echo htmlspecialchars($user['profilepic']) ? htmlspecialchars($user['profilepic']) : 'assets/images/slider/pic1.png'; ?>" alt="">
            </div>
            <div class="dz-content">
                <div class="left-content">
                    <span class="badge badge-primary d-inline-flex gap-1 mb-2"><i class="icon feather icon-map-pin"></i>Nearby</span>
                    <h4 class="title"><a href="profile-detail.php?id=<?php echo htmlspecialchars($user['id']); ?>"><?php echo htmlspecialchars($user['first_name']) . ', ' . htmlspecialchars($user['dob']); ?></a></h4>
                    <p class="mb-0" id="location"></p>
                </div>
                <a href="javascript:void(0);" class="dz-icon dz-sp-like" data-receiver-id="<?php echo $user['id']; ?>" onclick="sendNotification(<?php echo $user['id']; ?>, 'like')"><i class="flaticon flaticon-star-1"></i></a>
            </div>
            <div class="demo__card__choice m--reject">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <div class="demo__card__choice m--like">
                <i class="fa-solid fa-check"></i>
            </div>
            <div class="demo__card__choice m--superlike">
                <h5 class="title mb-0">Super Like</h5>
            </div>
            <div class="demo__card__drag"></div>
        </div>
		<?php
                }
            } else {
                echo "<p>No users found.</p>";
            }
            ?>

				<!-- <div class="demo__card">
					<div class="dz-media">
						<img src="assets/images/slider/pic3.png" alt="">
					</div>
					<div class="dz-content">
						<div class="left-content">
							<span class="badge badge-primary d-inline-flex gap-1 mb-2"><i class="icon feather icon-map-pin"></i>Nearby</span>
							<h4 class="title"><a href="profile-detail.php">Richard , 21</a></h4>
							<p class="mb-0"><i class="icon feather icon-map-pin"></i> 5 miles away</p>
						</div>
						<a href="javascript:void(0);" class="dz-icon dz-sp-like"><i class="flaticon flaticon-star-1"></i></a>
					</div>
					<div class="demo__card__choice m--reject">
						<i class="fa-solid fa-xmark"></i>
					</div>
					<div class="demo__card__choice m--like">
						<i class="fa-solid fa-check"></i>
					</div>
					<div class="demo__card__choice m--superlike">
						<h5 class="title mb-0">Super Like</h5>
					</div>
					<div class="demo__card__drag"></div>
				</div> -->
				
				<!-- <div class="demo__card">
					<div class="dz-media">
						<img src="assets/images/slider/pic4.png" alt="">
					</div>
					<div class="dz-content">
						<div class="left-content">
							<h4 class="title"><a href="profile-detail.php">Natasha , 22</a></h4>
							<p class="mb-0"><i class="icon feather icon-map-pin"></i> 2 miles away</p>
						</div>
						<a href="javascript:void(0);" class="dz-icon dz-sp-like"><i class="flaticon flaticon-star-1"></i></a>
					</div>
					<div class="demo__card__choice m--reject">
						<i class="fa-solid fa-xmark"></i>
					</div>
					<div class="demo__card__choice m--like">
						<i class="fa-solid fa-check"></i>
					</div>
					<div class="demo__card__choice m--superlike">
						<h5 class="title mb-0">Super Like</h5>
					</div>
					<div class="demo__card__drag"></div>
				</div>
				
				<div class="demo__card">
					<div class="dz-media">
						<img src="assets/images/slider/pic3.png" alt="">
					</div>
					<div class="dz-content">
						<div class="left-content">
							<h4 class="title"><a href="profile-detail.php">Lisa Ray , 25</a></h4>
							<ul class="intrest">
								<li><span class="badge">Photography</span></li>
								<li><span class="badge">Street Food</span></li>
								<li><span class="badge">Foodie Tour</span></li>
							</ul>
						</div>
						<a href="javascript:void(0);" class="dz-icon dz-sp-like"><i class="flaticon flaticon-star-1"></i></a>
					</div>
					<div class="demo__card__choice m--reject">
						<i class="fa-solid fa-xmark"></i>
					</div>
					<div class="demo__card__choice m--like">
						<i class="fa-solid fa-check"></i>
					</div>
					<div class="demo__card__choice m--superlike">
						<h5 class="title mb-0">Super Like</h5>
					</div>
					<div class="demo__card__drag"></div>
				</div>
				
				<div class="demo__card">
					<div class="dz-media">
						<img src="assets/images/slider/pic2.png" alt="">
					</div>
					<div class="dz-content">
						<div class="left-content">
							<span class="badge badge-primary mb-2">New here</span>
							<h4 class="title"><a href="profile-detail.php">Richard , 22</a></h4>
							<ul class="intrest">
								<li><span class="badge intrest">Climbing</span></li>
								<li><span class="badge intrest">Skincare</span></li>
								<li><span class="badge intrest">Dancing</span></li>
								<li><span class="badge intrest">Gymnastics</span></li>
							</ul>							
						</div>
						<a href="javascript:void(0);" class="dz-icon dz-sp-like"><i class="flaticon flaticon-star-1"></i></a>
					</div>
					<div class="demo__card__choice m--reject">
						<i class="fa-solid fa-xmark"></i>
					</div>
					<div class="demo__card__choice m--like">
						<i class="fa-solid fa-check"></i>
					</div>
					<div class="demo__card__choice m--superlike">
						<h5 class="title mb-0">Super Like</h5>
					</div>
					<div class="demo__card__drag"></div>
				</div> -->
			</div>
		</div>
	</div>
	<!-- Page Content End -->
	
	<!-- Menubar -->
	<div class="menubar-area footer-fixed">
		<div class="toolbar-inner menubar-nav">
			<a href="home.php" class="nav-link active">
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
			<a href="profile.php?user_id=<?php echo $user_id; ?>" class="nav-link">
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
<script src="assets/vendor/countdown/jquery.countdown.js"></script><!-- COUNTDOWN FUCTIONS  -->
<script src="assets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script><!-- Swiper -->
<script src="assets/js/tinderSwiper.min.js"></script>
<script src="assets/js/dz.carousel.js"></script><!-- Swiper -->
<script src="assets/js/settings.js"></script>
<script src="assets/js/custom.js"></script>
<!-- Bootstrap CSS -->

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
<script>
function showConsentModal() {
    $('#sidebar').hide();  // Hide the sidebar
    $('#consentModal').modal('show'); // Show the modal
}

function startLiveStream() {
    // Your logic to start the live stream
    console.log("Live stream started");
    $('#consentModal').modal('hide'); // Hide the modal
    $('#sidebar').show();  // Show the sidebar again (optional, based on your needs)
}

</script>

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
                    document.getElementById('location').innerText += `\n${city}, ${state}`;
                } else {
                    document.getElementById('location').innerText += `\nCity/State not found.`;
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
	<script>
		function sendNotification(receiverId, type) {
    const senderId = <?php echo $_SESSION['user_id']; ?>; // Assuming the logged-in user ID is stored in the session
    
    // Make AJAX request to PHP to store the notification
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'send_notification.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert('Notification sent!');
        }
    };
    xhr.send(`receiver_id=${receiverId}&sender_id=${senderId}&type=${type}`);
}

	</script>

<!-- Mirrored from datingkit.w3itexpert.com/xhtml/home.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 19 Oct 2023 01:39:52 GMT -->
</html>
