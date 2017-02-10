<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<?php
	include("commonheader.html");
	include("signupCreateAppl.php");
	?>

	<style type="text/css">

		table tr td{
			border-top: none !important;
        	border-left: none !important;
		}

		tr td:first-of-type{
			text-align: right;
			width: 40%;
		}

		input{
		 	background-color: #FFFFFF;
		}
		
	</style>

</head>

<body style="background: url(/Images/background_img.jpg); background-size: cover;">
	<div class="container" style="text-align: center; color: #FFFFFF">
		<h1 style="font-size: 80px; font-family: fontNum1;">
					Sign Up
		</h1>
	</div>

	<div class="container text-center">
		<div class="row">
			<div class="container" style="background-color: rgba(255,255,255,0.7); 
						margin-top: 20px; max-width: 800px; border-radius: 20px 0px;">
				<div class="row">
					<div class="col-md-12">
						<h2 style="color: #222222;">Get a Free Account for Job Applicants</h2>

						
							<form name="signup_applicant_form" action="signup.php" method="POST" style="margin-top: 5%;">
								<div class="row">
									<div class="col-md-12 table-responsive">
										<table class="table table-condensed borderless">
											<tr>
												<td><small>Username &nbsp;</small></td>
												<td class="text-left"><input type="text" name="username"
													placeholder="e.g. bucksbunny" value="<?php echo $uname;?>">
												<span style="font-size: 10px; color: #DD0000"><?php echo $unameErr?></span>
												</td>
											</tr>
											<tr>
												<td><small>First Name &nbsp;</small></td>
												<td class="text-left"><input type="text" name="f_name"
													placeholder="e.g. Kapil" value="<?php echo $fname;?>">
												<span style="font-size: 10px; color: #DD0000"><?php echo $fnameErr?></span>
												</td>
											</tr>
											<tr>
												<td><small>Last Name &nbsp;</small></td>
												<td class="text-left"><input type="text" name="l_name"
													placeholder="e.g. Dev" value="<?php echo $lname;?>">
													<span style="font-size: 10px; color: #DD0000"><?php echo $lnameErr?>
													</span>
													</td>
											</tr>
											<tr>
												<td><small>Password &nbsp;</small></td>
												<td class="text-left"><input type="Password" name="password"
													placeholder="Password">
													<span style="font-size: 10px; color: #DD0000">
													<?php echo $passErr?>
													</span>
													</td>
											</tr>
											<tr>
												<td><small>Confirm Password &nbsp;</small></td>
												<td class="text-left"><input type="Password" name="confirm_pass"
													placeholder="Confirm Password">
													<span style="font-size: 10px; color: #DD0000">
													<?php echo $confirm_passErr?>
													</span>
													</td>
											</tr>
											<tr>
												<td><small>Email ID &nbsp;</small></td>
												<td class="text-left"><input type="email" name="email_id"
													placeholder="e.g. someone@xyz.com" value="<?php echo $email?>">
													<span style="font-size: 10px; color: #DD0000"><?php echo $emailErr?>
													</span>
													</td>
											</tr>
											<tr>
												<td><small>Mobile Number &nbsp;</small></td>
												<td class="text-left"><input type="text" name="mob_num" maxlength="10"
													placeholder="Without +91" value="<?php echo $mobNum;?>">
													<span style="font-size: 10px; color: #DD0000"><?php echo $mobNumErr?>
													</span>
													</td>
											</tr>
											<tr>
												<td><small>Date of Birth &nbsp;</small></td>
												<td class="text-left"><input type="Date" name="date_of_birth"
													placeholder="YYYY-MM-DD" value="<?php echo $dob;?>">
													<span style="font-size: 10px; color: #DD0000">
														<?php echo $dobErr?>
													</span>
													</td>
											</tr>
										</table>
										<button type="submit" class="btn btn-default">Create Account</button>

										<div style="margin-top:1%; font-size: 15px;">
											By clicking 'Create Account', you agree to all the Terms and Conditions.
										</div>
										<div style="margin-top: 5%;"><small>Not an Applicant? Contact admin to get a free recruiter account</small></div>
										</div>
										<div style="margin-top: 5%;"><small>Already have an account? <a href="index.php">Login</a></small></div>
										</div>

								</div>
								<div style="margin-top:5%;">
									<small>&copy; ORP 2016</small>
								</div>
							</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>