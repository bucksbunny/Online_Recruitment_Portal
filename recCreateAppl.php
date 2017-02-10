<?php 
include("checkRecSession.php");

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

$sql = "SELECT company_name FROM recruiters WHERE username ='".$uname."';";

$result_query = $conn->query($sql);

if($result_query->num_rows != 1){
	die("Data Fetch Error. Please Try Again.");
}

$applDataArray = 1;

while($row = $result_query->fetch_assoc()){
	$_SESSION['companyName'] = $row['company_name'];
}

include('recCreateCheck.php');
//	PHP ends.
?>



<!DOCTYPE html>
<html>
<head>
	<title>Create Application - ORP</title>
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
		    background-repeat: no-repeat; background-attachment: fixed; background-position: center;  color: #FFFFFF"">
	<nav class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="userHome.php"
					style="font-family: fontNum1; font-size: 30px;">
					Recruitment Portal
				</a>
			</div>
			<ul class="nav navbar-nav navbar-right" style="font-size: 15px;">
				<li><a href="recHome.php">Home</a></li>
				<li class="active"><a href="#">Create Application</a></li>
				<li><a href="recViewAppl.php">View Applications</a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</nav>

	<div class="container-fluid text-center">
		<div class="row" style="background-color: rgba(153,0,0,0.7); color: #FFFFFF; padding-top: 5%;
				box-shadow: 0px 0px 20px #333333;">
			<div class="col-md-12">
				<h1>Create New Job Application</h1>
			</div>
		</div>

		<div class="row" style="padding-bottom: 5%">
			<div class="col-md-12">
				<form name="create_jobappl_form" action="recCreateAppl.php" method="POST" style="margin-top: 5%;">
								<div class="row">
									<div class="col-md-12 table-responsive">
										<table class="table table-condensed borderless">
											<tr>
												<td><small>Job Name &nbsp;</small></td>
												<td class="text-left"><input type="text" name="job_name"
													placeholder="e.g. SDE" value="<?php echo $jobName;?>">
												<span style="font-size: 10px; color: #DD0000"><?php echo $jobNameErr;?>
												</span>
												</td>
											</tr>
											<tr>
												<td><small>Job Profile &nbsp;</small></td>
												<td class="text-left">
													<select name="job_profile" style="color: #222222; min-width:200px;">
  														<option value="Engineer" selected>Engineer</option>
 														<option value="Analyst">Analyst</option>
														<option value="Consultant">Consultant</option>
  														<option value="Auditor">Auditor</option>
  														<option value="PA">P.A</option>
  														<option value="Manager">Manager</option>
													</select>
												<span style="font-size: 10px; color: #DD0000">
												<?php echo $jobProfileErr;?>
												</span>
												</td>
											</tr>
											<tr>
												<td><small>Job Salary(per annum) &nbsp;</small></td>
												<td class="text-left"><input type="number" name="job_salary"
													placeholder="e.g. 1000000" value="<?php echo $jobSalary;?>"
													min='0'>
												<span style="font-size: 10px; color: #DD0000">
												<?php echo $jobSalaryErr;?></span>
												</td>
											</tr>
										</table>
										<button type="submit" class="btn btn-default">Create</button>
										<button type="reset" class="btn btn-default">Reset</button>
										<a href="recHome.php" class="btn btn-default">Cancel</a>

								</div>
				</form>
		</div>
		
	</div>


</body>
</html>