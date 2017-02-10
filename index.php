<?php
session_start();
if(isset($_SESSION["is_logged_in"])){
	header("Location: /userHome.php");
}
if(isset($_SESSION["rec_logged_in"])){
	header("Location: /recHome.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Recruitment Portal</title>
	<?php
	include("commonheader.html");
	include("loginCreate.php");
	?>

	<style type="text/css">
		 input{
		 	background-color: #FFFFFF;
		 }
	</style>

</head>

<body style="background: url(/Images/background_img.jpg); background-size: cover;">
	<div class="container" style="text-align: center; color: #FFFFFF">
		<h1 style="font-size: 80px;
					font-family: fontNum1;">
					Recruitment Portal
		</h1>
	</div>

	<div class="container text-center">
		<div class="row">
			<div class="container" style="background-color: rgba(255,255,255,0.7); 
						margin-top: 20px; max-width: 500px; border-radius: 20px 0px;">
				<div class="row">
					<div class="col-md-12">
						<h2 style="color: #660000;">Your portal to the perfect job</h2>

						<div class="form-group">
 							<form name="login_form" method="POST" action="index.php" style="margin-top: 10%;">
 								<span style="font-size:15px; color: #DD0000;
										visibility: <?php if($error_msg==NULL || $error_msg=="") echo "hidden"; else echo "visible";?>">
										<?php echo $error_msg?>
								</span>
								<input type="text" name="username" placeholder="Username"
									autofocus="autofocus" value="<?php echo $uname; ?>">
									<br><br>
								<input type="password" name="pass" placeholder="Password">
									<br><br>
								<button type="submit" class="btn btn-default" style="width: ">Login</button>
							</form>
						</div>
						
						<div style="margin-top: 10%;"><small>Don't have an account? <a href="signup.php">Sign up</a></small></div>
						
						<div style="margin-top: 5%;">
							<small>&copy; ORP 2016</small>
						</div>
					</div>
					<!--
					<div class="col-md-6" style="border-left: 1px solid brown;">
						<h2 style="color: #660000;">Sign Up</h2>
					</div>
					-->
				</div>
			</div>
		</div>
	</div>

</body>
</html>