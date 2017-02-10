<?php

include("checkSession.php");

$servername = "localhost";
$username = "guestuser";
$password = "guestuser";
$database = "login";

$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error){
//	To be changed
	die("Connection Error : ".$conn->connect_error);
}

$sql_get_appl = "SELECT A.job_id, R.company_name , A.job_name, A.job_profile, A.job_salary, AAP.appl_status
					FROM applicant_applications AS AAP
					INNER JOIN Applications AS A
					ON AAP.job_id = A.job_id
					INNER JOIN recruiters as R
					ON R.username = A.recruiter_uname
					WHERE AAP.applicant_uname = '".$_SESSION['uname']."'
					ORDER BY AAP.appl_status, AAP.apply_date DESC;";

$result_fetch = $conn->query($sql_get_appl);

if($result_fetch->num_rows==0){
	die("You haven't applied anwhere yet!");
}

while($row = $result_fetch->fetch_assoc()){

	echo "	<div class='row' style='margin-top: 1%'>
				<div class='container cards text-left' onmouseover='boxshadowchange(this);'
			onmouseout = 'boxshadowrevert(this);'>
					<div class='row'>
						<div class='col-md-12' style='color: rgb(0,153,0);'>
							<h3>".$row['company_name']."</h3>
						</div>
					</div>
					<div class='row'>
						<div class='col-md-4 text-center'>
							Job ID - ".$row['job_id']."
						</div>
						<div class='col-md-4 text-center'>
							".$row['job_name']."
						</div>
						<div class='col-md-4 text-center'>
							".$row['job_profile']."
						</div>
					</div>
					<div class='row'>
						<div class='col-md-4 text-center'>
							Rs ".$row['job_salary']." p.a
						</div>
						<div class='col-md-4 text-center'>
							<!--Empty-->
						</div>
						<div class='col-md-4 text-center'>Status - 
							";
	
	if($row['appl_status']=='Accepted'){
		echo "<span style='color:#00CC00;'>".$row['appl_status']."</span>";
	}
	else if($row['appl_status']=='Rejected'){
		echo "<span style='color:#CC0000;'>".$row['appl_status']."</span>";
	}
	else{
		echo "<span style='color:gold;'>".$row['appl_status']."</span>";
	}

	echo "				</div>
					</div>
				</div>
			</div>";
}

?>