<!DOCTYPE html>
<html lang="en">
<head>
	<title>Multi-step Registration</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
	<meta name="theme-color" content="#FF50A2">

	<!-- Stylesheets -->
	<link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/style.css">
	<style>
		.select-input{
			border-radius: 5px;
			padding: 10px;
		}
	</style>
</head>   
<body class="bg-white">
<div class="page-wrapper">
	<div class="page-content">
		<div class="container">
			<div class="account-area">
				<!-- Multi-step form begins here -->
				<form action="login_code.php" method="post">
					<!-- Step 1: Email -->
						<div class="account-area">
							<div class="section-head ps-0">
								<h3>Please login</h3>
							</div>
							<div class="input-group dz-select">
								<input type="email" id="emailInput" name="email" class="form-control" placeholder="example@gmail.com" required>
							</div>
							<div class="input-group dz-select">
								<input type="password" name="password" class="form-control" placeholder="Enter your password" required>
							</div>
						</div>
						<div class="mt-4">
							<button type="submit" name="submit" class="btn btn-primary w-100">Login</button>
						</div>
						<p class="center">Don't have an account? <a href="register.php">Register</a></p>
				</form>
				<!-- Multi-step form ends here -->
			</div>
		</div>
	</div>
</div>

<!--**********************************
    Scripts
***********************************-->
<script src="assets/js/jquery.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/custom.js"></script>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		const form = document.getElementById("registrationForm");
		const steps = document.querySelectorAll(".step");
		const nextBtn = document.querySelector(".next");
		const prevBtn = document.querySelector(".previous");
		const submitBtn = document.querySelector(".submit");

		let currentStep = 0;

		// Show the first step initially
		showStep(currentStep);

		// Function to display the current step and hide others
		function showStep(stepIndex) {
			steps.forEach((step, index) => {
				step.style.display = (index === stepIndex) ? 'block' : 'none';  // Display current step, hide others
			});

			// Button visibility control
			if (stepIndex === 0) {
				prevBtn.style.display = "none";  // Hide "Previous" on the first step
			} else {
				prevBtn.style.display = "inline";  // Show "Previous" button otherwise
			}

			if (stepIndex === steps.length - 1) {
				nextBtn.style.display = "none";  // Hide "Next" on the last step
				submitBtn.style.display = "inline";  // Show "Submit" on the last step
			} else {
				nextBtn.style.display = "inline";  // Show "Next" on intermediate steps
				submitBtn.style.display = "none";  // Hide "Submit" until the last step
			}
		}

		// Handle the "Next" button click
		nextBtn.addEventListener("click", function() {
			if (currentStep < steps.length - 1) {
				currentStep++;
				showStep(currentStep);
			}
		});

		// Handle the "Previous" button click
		prevBtn.addEventListener("click", function() {
			if (currentStep > 0) {
				currentStep--;
				showStep(currentStep);
			}
		});

		// Form submission handler
		form.addEventListener("submit", function(e) {
			e.preventDefault();
			alert("Form submitted successfully!");
		});
	});
</script>

<script>
    // Get the email input and the Next button
    const emailInput = document.getElementById('emailInput');
    const nextButton = document.getElementById('nextButton');
    const firstName = document.getElementById('firstName');

    // Disable the Next button initially
    nextButton.disabled = true;

    // Add an event listener to the email input
    emailInput.addEventListener('input', function() {
        // Check if the email input is not empty and is valid
        if (emailInput.value.trim() !== '' && validateEmail(emailInput.value)) {
            nextButton.disabled = false; // Enable the Next button
        } else {
            nextButton.disabled = true; // Disable the Next button
        }
    });

    // Function to validate email format
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    }
</script>

</body>
</html>
