<?php

include("checkRecSession.php");

$servername = "localhost";
$username = "guestuser";
$password = "guestuser";
$database = "login";

$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error){
//	To be changed
	die("Connection Error : ".$conn->connect_error);
}

$sql_get_appl = "SELECT * from Applications
					WHERE recruiter_uname = '".$_SESSION['uname']."'
					ORDER BY job_create_date;";

$result_fetch = $conn->query($sql_get_appl);

if($result_fetch->num_rows==0){
	die("You haven't created any jobs yet!");
}

while($row = $result_fetch->fetch_assoc()){

	echo "	<div class='row' style='margin-top: 1%'>
				<div class='container cards text-left' onmouseover='boxshadowchange(this);'
			onmouseout = 'boxshadowrevert(this);'>
					<div class='row'>
						<div class='col-md-12' style='color: rgb(0,0,153);'>
							<h3><u><strong>JOB ID - ".$row['job_id']."</strong></u></h3>
						</div>
					</div>
					<div class='row'>
						<div class='col-md-4 text-center'>
							".$row['job_name']."
						</div>
						<div class='col-md-4 text-center'>
							".$row['job_profile']."
						</div>
						<div class='col-md-4 text-center'>
							Rs ".$row['job_salary']." p.a
						</div>
					</div>
					<div class='row'>
						<div class='col-md-12 text-center table-responsive'><br>
							";

	$sql_get_applicants = "SELECT A.f_name, A.l_name, A.mob_num, A.resume_link, A.username
							FROM applicant_applications as AAP
							JOIN applicants as A
							ON AAP.applicant_uname = A.username
							WHERE AAP.job_id = '".$row['job_id']."'
							AND AAP.appl_status = 'waiting';";

	$result_applicant_fetch = $conn->query($sql_get_applicants);

	if($result_applicant_fetch->num_rows==0){
		echo "<small>No applicants yet</small>";
	}
	else{

		echo "<table class='table table-condensed'>
								<tr>
									<th>Name</th>
									<th>Mob Num</th>
									<th>Resume</th>
									<th>Action</th>
								</tr>";

		while($minirow = $result_applicant_fetch->fetch_assoc()){
			echo "	<tr>
						<td>".$minirow['f_name']." ".$minirow['l_name']."</td>
						<td>".$minirow['mob_num']."</td>
						<td><a href='".$minirow['resume_link']."' target='_blank'>Resume</td>
						<td><form action='acceptReject.php' method='post'>
							<input type='hidden' name='applicant_uname' value='".$minirow['username']."'>
							<input type='hidden' name='job_id' value='".$row['job_id']."'>
							<input type='submit' name='accept' style='min-width:auto;' class='btn btn-success' value='Accept'>
							<input type='submit' name='reject' style='min-width:auto;' class='btn btn-danger' value='Reject'>
							</form>
						</td>
					</tr>";
		}

		echo "</table>";

	}


	echo "					
						</div>
					</div>
				</div>
			</div>";
}

?>