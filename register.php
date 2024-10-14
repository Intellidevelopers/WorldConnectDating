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
				<form action="code.php" method="post" enctype="multipart/form-data">
                <div class="section-head ps-0">
								<h3>Welcome Please Signup</h3>
							</div>
					<!-- Step 1: Email -->
						<div class="account-area">
							<div class="section-head ps-0">
								<h5>Email</h5>
							</div>
							<div class="input-group dz-select">
								<input type="email" id="emailInput" name="email" class="form-control" placeholder="example@gmail.com" required>
							</div>
						</div>
						<div class="account-area">
							<div class="section-head ps-0">
								<h5>Password</h5>
							</div>
							<div class="input-group dz-select">
								<input type="password" name="password" class="form-control" placeholder="********" required>
							</div>
						</div>
						<div class="account-area">
							<div class="section-head ps-0">
								<h5>Confirm password</h5>
							</div>
							<div class="input-group dz-select">
								<input type="password" name="passwordRepeat" class="form-control" placeholder="confirm password" required>
							</div>
						</div>

					<!-- Step 2: First Name -->
						<div class="account-area">
							
							<div class="section-head ps-0">
								<h5>First name</h5>
							</div>
							<div class="mb-2 input-group input-group-icon input-mini">
								<div class="input-group-text">
									<div class="input-icon">
										<i class="icon feather icon-user"></i>
									</div>
								</div>
								<input type="text" name="first_name" id="firstName" class="form-control" placeholder="Enter first name" required>								
							</div>
					</div>

					<!-- Step 3: Date of Birth -->
						<div class="account-area">
							<div class="section-head ps-0">
								<h5>Age</h5>
							</div>
							<div class="mb-2 input-group input-group-icon input-mini">
								<div class="input-group-text">
									<div class="input-icon">
										<i class="icon feather icon-calendar"></i>
									</div>
								</div>
								<input type="text" name="dob" placeholder="18 - 80" class="form-control" required>								
							</div>
						</div>

					<!-- Step 4: Gender -->
						<div class="account-area">
							<div class="section-head ps-0">
								<h5>What's your gender ?</h5>
							</div>
							<div class="select style-2">
								<label for="gender-select" class="select-label">Gender</label>
								<select id="gender-select" name="gender" class="select-input" required>
									<option value="female" selected>Female</option>
									<option value="male">Male</option>
									<option value="other">Other</option>
								</select>
							</div>
						</div>

					<!-- Step 5: Profile and Submit -->
						<div class="account-area">
							<div class="section-head ps-0">
								<h5>Your sexual orientation?</h5>
							</div>
							<select id="gender-select" name="sexual_orientation" class="select-input" required>
								<option value="Straight" selected>Straight</option>
								<option value="Gay">Gay</option>
								<option value="Lesbian">Lesbian</option>
								<option value="Bisexual">Bisexual</option>
								<option value="Asexual">Asexual</option>
								<option value="Heterosexual">Heterosexual</option>
								<option value="Homosexual">Homosexual</option>
								<option value="other">Other</option>
							</select>
                            <div class="section-head ps-0">
                                <h5>Do you have any kids? (if yes, please specify the ages)</h5>
                                <input type="text" name="kids_ages" placeholder="e.g., 12, 15, 18" class="form-control">
                            </div>
							<div class="section-head ps-0">
								<h5>Who are you interested in seeing ?</h5>
							</div>
							<select id="gender-select" name="interest" class="select-input" required>
								<option value="Sugar Mummy" selected>Sugar Mummy</option>
								<option value="Sugar Daddy">Sugar Daddy</option>
								<option value="Hookup">Hookup</option>
								<option value="Jigolo">Jigolo</option>
								<option value="Gay">Gay</option>
								<option value="FWB">FWB</option>
							</select>
						</div>
	
						<div class="account-area">
							<div class="section-head ps-0">
								<h5>Add your recent pics</h5>
							</div>
							<div class="row g-3"  data-masonry='{"percentPosition": true }'>
								<div class="col-8">
									<div class="dz-drop-box">
										<div class="drop-bx bx-lg">
                                        <div id="profilePreview" class="imagePreview" style="background-image: url(assets/images/recent-pic/drop-bx.png);">
                                            <div class="remove-img remove-btn d-none"><i class="icon feather icon-x"></i></div>
                                            <input type='file' class="form-control d-none imageUpload" name="profilepic" id="profileImageUpload" accept=".png, .jpg, .jpeg">
                                            <label for="profileImageUpload"></label>
                                        </div>
										</div>
									</div>
								</div>
								<div class="col-4">
									<div class="dz-drop-box">
										<img src="assets/images/recent-pic/drop-bx.png" alt="">
										<div class="drop-bx">
											<div class="imagePreview" style="background-image: url(assets/images/recent-pic/drop-bx.png);">
												<div  class="remove-img remove-btn d-none"><i class="icon feather icon-x"></i></div>
												<input type='file' class="form-control d-none imageUpload" name="photo"  id="imageUpload5" accept=".png, .jpg, .jpeg">
												<label for="imageUpload5"></label>
											</div>
										</div>
									</div>
								</div>
								
							</div>
                            <div class="section-head ps-0">
                                <h5>Tell us about your education and work experience</h5>
                                <div class="row g-3">
                                    
                                    <div class="col-6">
                                        <input type="text" name="education" placeholder="Education" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="work_experience" placeholder="Work Experience" class="form-control">
                                    </div>
                                    <div class="col-12">
                                        <input type="text" name="occupation" placeholder="Occupation" class="form-control">
                                    </div>
                                    <div class="col-12">
                                        <input type="text" name="company" placeholder="Company" class="form-control">
                                    </div>
									<div class="col-12">
                                        <input type="text" name="about" placeholder="About yourself" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="start_date" placeholder="Start Date" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="end_date" placeholder="End Date" class="form-control">
                                        <small class="form-text text-muted">If you don't have an end date, leave it blank.</small>
                                    </div>
                                </div>
							<div class="mt-4">
									<button type="submit" name="submit" class="btn btn-primary w-100">Signup</button>
							</div>
						</div>
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
