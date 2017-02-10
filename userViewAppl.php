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

$sql = "SELECT username, f_name, l_name FROM applicants WHERE username ='".$uname."';";

$result_query = $conn->query($sql);

if($result_query->num_rows != 1){
	die("Data Fetch Error. Please Try Again.");
}

$applDataArray = 1;

while($row = $result_query->fetch_assoc()){
	$applDataArray = array('uname' => $row["username"], 'f_name' => $row['f_name'], 'l_name' => $row['l_name']);
}

//	PHP ends.
?>



<!DOCTYPE html>
<html>
<head>
	<title>My Applications</title>
	<?php
	include("commonheader.html");
	?>

	<style type="text/css">

		table tr th{
			border-top: none !important;
			border-left: none !important;
			font-size: 17px;
			text-align: center;
		}

		table tr td{
			border-top: none !important;
        	border-left: none !important;
        	font-size: 17px;
		}
	</style>

	<script type="text/javascript">
		function boxshadowchange(elem){
			elem.style.boxShadow = '0px 0px 20px rgba(0,153,0,1)';
			elem.style.borderRadius = '30px 0px';
		}

		function boxshadowrevert(elem){
			elem.style.boxShadow = '0px 0px 20px #555555';
			elem.style.borderRadius = '20px 0px';
		}

	</script>

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
				<li><a href="userEditDetails.php">Edit Details</a></li>
				<li><a href="userSearchJobs.php">Search Jobs</a></li>
				<li class="active"><a href="#">My Applications</a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</nav>


	<div class="container-fluid text-center">
		<div class="row" style="background-color: rgba(0,153,0,0.7); color: #FFFFFF; padding-top: 5%;
					box-shadow: 0px 0px 20px #333333;">
			<div class="col-md-12">
				<h1>My Applications</h1>
			</div>
		</div>
		<div class="row" style="padding-top: 1%">
			<div class="col-md-12">
				<?php include('getAppl.php');?>
			</div>
		</div>

		
		
		
		<!--
		<div class="row" style="margin-top: 1%">
			<div class="container cards text-left">
				Hello
			</div>
		</div>

		<div class="row" style="margin-top: 1%">
			<div class="container cards text-left">
				Hello
			</div>
		</div>

		-->
	</div>

</body>
</html>