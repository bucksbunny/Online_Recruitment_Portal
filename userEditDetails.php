<?php
include("checkSession.php");

$uname = $_SESSION['uname'];
$servername = "localhost";
$username = "guestuser";
$password = "guestuser";
$database = "login";


$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error){
	//	To be changed
	die("Connection Error : ".$conn->connect_error);
}

$sql = "SELECT * FROM applicants WHERE username ='".$uname."';";

$result_query = $conn->query($sql);

if($result_query->num_rows != 1){
	die("Data Fetch Error. Please Try Again.");
}


while($row = $result_query->fetch_assoc()){
	$applDataArray = array('uname' => $row["username"], 'f_name' => $row['f_name'], 'l_name' => $row['l_name'], 
							'email_id' => $row['email_id'], 'mob_num' => $row['mob_num'],
							'date_of_birth' => $row['date_of_birth'], 'city' => $row['city'],
							'state' => $row['state'], 'pin_code' => $row['pin_code'], 
							'resume_link' => $row['resume_link']);
}

include("userCheckEdit.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Details</title>
	<?php
	include("commonheader.html");
	?>

	<style type="text/css">

		table tr td{
			border-top: none !important;
        	border-left: none !important;
		}

		tr td:first-of-type{
			text-align: right;
			width: 45%;
		}
	</style>

</head>
<body style="background: url(/Images/grey-background.png); background-size: cover;
		    background-repeat: no-repeat; background-attachment: fixed; background-position: center;  color: #FFFFFF">
	<nav class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="userHome.php"
					style="font-family: fontNum1; font-size: 30px;">
					Recruitment Portal
				</a>
			</div>
			<ul class="nav navbar-nav navbar-right" style="font-size: 15px;">
				<li><a href="userHome.php">Home</a></li>
				<li class="active"><a href="userEditDetails.php">Edit Details</a></li>
				<li><a href="userSearchJobs.php">Search Jobs</a></li>
				<li><a href="userViewAppl.php">My Applications</a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</nav>


	<div class="container-fluid text-center">
		<div class="row" style="background-color: rgba(0,153,0,0.7); color: #FFFFFF; padding-top: 5%;
			box-shadow: 0px 0px 20px #333333;">
			<div class="col-md-12">
				<h1>Edit Personal Details</h1>
			</div>
		</div>

		<div class="row" style="padding-bottom: 5%;">
			<div class="col-md-12">
				<form name="update_applicant_form" action="userEditDetails.php" method="POST" style="margin-top: 5%;">
								<div class="row">
									<div class="col-md-12 table-responsive">
										<table class="table table-condensed borderless">
											<tr>
												<td><small>Username &nbsp;</small></td>
												<td style="padding-left: 7%;" class=text-left><small><?php echo $_SESSION['uname'];?></small></td>
											</tr>
											<tr>
												<td><small>First Name &nbsp;</small></td>
												<td class="text-left"><input type="text" name="f_name"
													placeholder="e.g. Kapil" autocomplete="off"
													value="<?php if($fname=="" || $fname==NULL)
																	{echo $applDataArray['f_name'];}
															else {echo $fname;}?>">
												<span style="font-size: 10px; color: #DD0000"><?php echo $fnameErr?></span>
												</td>
											</tr>
											<tr>
												<td><small>Last Name &nbsp;</small></td>
												<td class="text-left"><input type="text" name="l_name"
													placeholder="e.g. Dev" autocomplete="off"
													value="<?php if($lname=="" || $lname==NULL)
																	{echo $applDataArray['l_name'];}
															else {echo $lname;}?>">
													<span style="font-size: 10px; color: #DD0000"><?php echo $lnameErr?>
													</span>
													</td>
											</tr>
											<tr>
												<td><small>Email ID &nbsp;</small></td>
												<td class="text-left"><input type="email" name="email_id"
													placeholder="e.g. someone@xyz.com" autocomplete="off"
													value="<?php if($email=="" || $email==NULL)
																	{echo $applDataArray['email_id'];}
															else {echo $email;}?>">
													<span style="font-size: 10px; color: #DD0000"><?php echo $emailErr?>
													</span>
													</td>
											</tr>
											<tr>
												<td><small>Mobile Number &nbsp;</small></td>
												<td class="text-left"><input type="text" name="mob_num" maxlength="10"
													placeholder="Without +91" autocomplete="off"
													value="<?php if($mobNum=="" || $mobNum==NULL)
																	{echo $applDataArray['mob_num'];}
															else {echo $mobNum;}?>">
													<span style="font-size: 10px; color: #DD0000"><?php echo $mobNumErr?>
													</span>
													</td>
											</tr>
											<tr>
												<td><small>Date of Birth &nbsp;</small></td>
												<td class="text-left"><input type="Date" name="date_of_birth"
													placeholder="YYYY-MM-DD" autocomplete="off"
													value="<?php if($dateOfBirth=="" || $dateOfBirth==NULL)
																	{echo $applDataArray['date_of_birth'];}
															else {echo $dob;}?>">
													<span style="font-size: 10px; color: #DD0000">
														<?php echo $dobErr?>
													</span>
													</td>
											</tr>

											<!--	Now, details about city and pincode -->
											<tr>
												<td><small>City &nbsp;</small></td>
												<td class="text-left"><input type="text" name="city"
													placeholder="e.g. New Delhi" autocomplete="off"
													value="<?php if($city=="" || $city==NULL)
																	{echo $applDataArray['city'];}
															else {echo $city;}?>">
													</td>
											</tr>
											<tr>
												<td><small>State &nbsp;</small></td>
												<td class="text-left"><input type="text" name="state"
													placeholder="e.g. Delhi" autocomplete="off"
													value="<?php if($state=="" || $state==NULL)
																	{echo $applDataArray['state'];}
															else {echo $state;}?>">
													</td>
											</tr>
											<tr>
												<td><small>Pincode &nbsp;</small></td>
												<td class="text-left"><input type="text" name="pin_code"
	-												placeholder="e.g. 110075" maxlength="6" autocomplete="off"
													value="<?php if($pinCode=="" || $pincCode==NULL)
																	{echo $applDataArray['pin_code'];}
															else {echo $pinCode;}?>">
													<span style="font-size: 10px; color: #DD0000"><?php echo $pinCodeErr?>
													</span>
													</td>
											</tr>
											<tr>
												<td><small>Resume Link &nbsp;</small></td>
												<td class="text-left"><input type="text" name="resume_link"
													placeholder="e.g. link to a pdf on google drive" autocomplete="off"
													value="<?php if($resumeLink=="" || $resumeLink==NULL)
																	{echo $applDataArray['resume_link'];}
															else {echo $resumeLink;}?>">
													</td>
											</tr>
										</table>
										<button type="submit" class="btn btn-default">Update</button>
										<button type="reset" class="btn btn-default">Reset</button>
										<a href="userViewDetails.php" class="btn btn-default">Cancel</a>

								</div>
				</form>
		</div>
		
	</div>

</body>
</html>