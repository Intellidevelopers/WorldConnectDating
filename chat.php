<?php
// chat.php

// Start the session if needed
session_start();

// Include your database connection
include 'dbconn.php'; // Ensure you have your DB connection file

// Check if user_id is set in the URL
if (isset($_GET['user_id'])) {
    $viewed_user_id = $_GET['user_id'];

    // Sanitize the input to prevent SQL injection
    $viewed_user_id = intval($viewed_user_id); // Assuming user_id is an integer

    // Query to fetch user details by user_id
    $sql = "SELECT * FROM users WHERE id = ?";
    
    // Prepare statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("i", $viewed_user_id);

        // Execute the statement
        $stmt->execute();

        // Get result
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows > 0) {
            // Fetch user details
            $user_details = $result->fetch_assoc();
            // Now you can access user details
            $first_name = $user_details['first_name'];
            $dob = $user_details['dob'];
            $profilepic = $user_details['profilepic'];
            // Add more fields as needed
        } else {
            echo "User not found.";
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error in preparing statement.";
    }
} else {
    echo "No user ID provided.";
}

// Close database connection
$conn->close();
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

	<!-- Additional CSS for Swipe Actions -->
	<style>
		/* Swipe action */
		.message-item {
			position: relative;
			overflow: hidden; /* To hide the swipe actions */
			transition: transform 0.3s ease;
			padding: 10px;
			border-radius: 10px;
			margin-bottom: 5px;
		}

		.swipe-reply, .swipe-delete {
			position: absolute;
			top: 0;
			bottom: 0;
			width: 100px;
			display: flex;
			align-items: center;
			justify-content: center;
			color: #fff;
			font-weight: bold;
			transition: transform 0.3s ease;
			z-index: 1;
			cursor: pointer;
		}

		.swipe-reply {
			left: 0;
			background-color: #4CAF50; /* Green */
			transform: translateX(-100%);
		}

		.swipe-delete {
			right: 0;
			background-color: #f44336; /* Red */
			transform: translateX(100%);
		}

		.message-item.swiped-right .swipe-reply {
			transform: translateX(0);
		}

		.message-item.swiped-left .swipe-delete {
			transform: translateX(0);
		}

		.bubble {
			background-color: #e0e0e0;
			padding: 10px 15px;
			border-radius: 15px;
			display: inline-block;
			max-width: 100%;
			position: relative;
		}

		.chat-content.user .bubble {
			background-color: #0084ff;
			color: #fff;
			margin-left: auto;
		}

		.message-time {
			font-size: 0.8em;
			color: #888;
			margin-top: 5px;
			display: block;
			text-align: right;
		}
	</style>
</head>   
<body class="bg-white header-large">
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
					<div class="left-content me-3">
						<a href="javascript:void(0);" class="back-btn">
							<i class="icon feather icon-chevron-left"></i>
						</a>
					</div>
					<div class="mid-content d-flex align-items-center text-start">
						<a href="javascript:void(0);" class="media media-40 rounded-circle me-3">
							<img src="<?php echo htmlspecialchars($profilepic); ?>" alt="<?php echo htmlspecialchars($first_name); ?>" />
						</a>
						<div>
							<a href="profile-detail.php?user_id=<?php echo $viewed_user_id; ?>">
								<h6 class="title"><?php echo htmlspecialchars($first_name) . ', ' . htmlspecialchars($dob); ?></h6>
							</a>
							<span>Online</span>
						</div>    
					</div>

					<div class="right-content d-flex align-items-center">
						<a href="javascript:void(0);" class="dz-icon btn btn-primary light">
							<i class="fa-solid fa-phone"></i>
						</a>
						<a href="javascript:void(0);" class="dz-icon me-0 btn btn-primary light">
							<i class="fa-solid fa-video"></i>
						</a>
					</div>
				</div>
			</div>
		</header>
	<!-- Header -->
	
	<!-- Page Content Start -->
	<div class="page-content space-top p-b60 message-content">
		<div class="container"> 
			<div id="messageContainer" class="chat-box-area"> 
				<!-- Example Messages -->
			
				<!-- End of Messages -->
			</div>
		</div> 
	</div>
	<!-- Page Content End -->
	<footer class="footer border-top fixed bg-white">
        <div class="container p-2">
            <div class="chat-footer">
                <form>
    				<input type="hidden" id="receiverId" value="1"> <!-- Replace with the actual receiver ID -->
                    <div class="form-group">
                        <div class="input-wrapper message-area">
							<div class="append-media"></div>
                            <input type="text" id="messageInput" class="form-control" placeholder="Send message...">
                            <a href="javascript:void(0);" id="sendButton" class="btn btn-chat btn-icon btn-primary light p-0 btn-rounded dz-flex-box">
                               <i class="icon feather icon-send"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>    
        </div>
    </footer>
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

<!-- Additional JavaScript for Swipe Actions -->
<script>
    $(document).ready(function () {
        // Variables to track touch positions
        let startX, startY, isSwiping = false;

        // Function to handle swipe actions
        $('.message-item').on('touchstart mousedown', function (e) {
            const touch = e.type === 'touchstart' ? e.originalEvent.touches[0] : e;
            startX = touch.clientX;
            startY = touch.clientY;
            isSwiping = true;
            $(this).removeClass('swiped-right swiped-left');
        });

        $('.message-item').on('touchmove mousemove', function (e) {
            if (!isSwiping) return;
            const touch = e.type === 'touchmove' ? e.originalEvent.touches[0] : e;
            const deltaX = touch.clientX - startX;
            const deltaY = touch.clientY - startY;

            // Prevent vertical scrolling interference
            if (Math.abs(deltaY) > Math.abs(deltaX)) {
                return;
            }

            // Right swipe (Reply)
            if (deltaX > 50) {
                $(this).addClass('swiped-right');
                isSwiping = false;
            }
            // Left swipe (Delete)
            else if (deltaX < -50) {
                $(this).addClass('swiped-left');
                isSwiping = false;
            }
        });

        $('.message-item').on('touchend mouseup mouseleave', function (e) {
            isSwiping = false;
        });

        // Click on swipe-reply to trigger reply action
        $('.swipe-reply').on('click', function (e) {
            e.stopPropagation();
            const messageBubble = $(this).siblings('.bubble').text();
            // Populate the input with the reply message (you can customize this)
            $('.message-area input').val(`Replying to: "${messageBubble}" `).focus();
            // Hide the swipe-reply
            $(this).closest('.message-item').removeClass('swiped-right');
        });

        // Click on swipe-delete to trigger delete action
        $('.swipe-delete').on('click', function (e) {
            e.stopPropagation();
            const messageItem = $(this).closest('.message-item');
            // Confirm deletion
            if (confirm('Are you sure you want to delete this message?')) {
                messageItem.fadeOut(300, function () {
                    $(this).remove();
                });
            } else {
                // If not confirmed, remove the swipe-left class to hide the delete button
                messageItem.removeClass('swiped-left');
            }
        });

        // Optional: Hide swipe actions when clicking outside
        $(document).on('click touchstart', function (e) {
            if (!$(e.target).closest('.message-item').length) {
                $('.message-item').removeClass('swiped-right swiped-left');
            }
        });
    });
</script>

<script>
	$('#sendButton').on('click', function() {
    var message = $('#messageInput').val();
    var receiver_id = $('#receiverId').val(); // The ID of the user you're chatting with

    $.ajax({
        url: 'sendMessage.php',
        type: 'POST',
        data: { message: message, receiver_id: receiver_id },
        success: function(response) {
            $('#messageInput').val(''); // Clear input field
            fetchMessages(); // Reload the chat
        }
    });
});

</script>

<script>
    // Fetch the session user ID from PHP and assign it to a JavaScript variable
    var userId = parseInt(<?php echo json_encode($_SESSION['user_id']); ?>);  // Make sure it's an integer

    function fetchMessages() {
        var receiver_id = $('#receiverId').val();

        $.ajax({
            url: 'getMessages.php',
            type: 'POST',
            data: { receiver_id: receiver_id },
            success: function(response) {
                var messages = JSON.parse(response);
                var messageContainer = $('#messageContainer');
                messageContainer.empty(); // Clear the container

                messages.forEach(function(message) {
                    // Compare message sender ID to session user ID
                    var msgClass = (message.sender_id == userId) ? 'sent-message' : 'incoming-message';
                    var messageItem = `
                        <div class="chat-content user ${msgClass}">
                            <div class="message-item">
                                <div class="bubble">${message.message}</div>
                                <div class="message-time">${message.timestamp}</div>
                            </div>
                        </div>`;
                    messageContainer.append(messageItem);
                });
            }
        });
    }

    // Fetch messages every 2 seconds to simulate real-time updates
    setInterval(fetchMessages, 2000);

</script>


</body>
</html>
