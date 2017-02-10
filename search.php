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

if($_SERVER['REQUEST_METHOD'] == 'GET'){

	$term = $_GET['job_search'];

	if($term=="" || $term==NULL){
		die("");
	}

	$sql_search = "SELECT A.job_id, A.job_name, A.job_profile, A.job_salary, A.recruiter_uname, R.company_name
					FROM login.Applications AS A
					INNER JOIN login.recruiters AS R
					ON A.recruiter_uname = R.username
					WHERE UPPER(A.job_profile) LIKE UPPER('%".$term."%')
					OR UPPER(A.job_name) LIKE UPPER('%".$term."%')
					OR UPPER(R.company_name) LIKE UPPER('%".$term."%')
					ORDER BY A.job_create_date DESC;";

	$result_search = $conn->query($sql_search);

	if($result_search->num_rows == 0){
		die("No Match Found. Please Try Again");
	}

	echo "<table class='table table-condensed'>
						<tr>
							<th>Job ID</th>
							<th>Company Name</th>
							<th>Job Name</th>
							<th>Job Profile</th>
							<th>Salary (Rs per Annum)</th>
							<th></th>
						</tr>";


	while($row = $result_search->fetch_assoc()){
		
		$sql_check_applied = "SELECT * FROM applicant_applications
								WHERE job_id='".$row['job_id']."'
								AND applicant_uname = '".$_SESSION['uname']."';";

		if(($conn->query($sql_check_applied))->num_rows == 0 ){
			$checkApplied = false;
		}
		else{
			$checkApplied = true;
		}
		

		echo "<tr>
				<form action='applyToJob.php' method='POST'>
				<td><input name='job_id' type='text' value='".$row['job_id']."' readonly='readonly'>
				</td>
				<td><input name='company_name' type='text' value='".$row['company_name']."' disabled='disabled'>
				</td>
				<td><input name='job_name' type='text' value='".$row['job_name']."' disabled='disabled'>
				</td>
				<td><input name='job_profile' type='text' value='".$row['job_profile']."' disabled='disabled'>
				</td>
				<td><input name='job_salary' type='text' value='".$row['job_salary']."' disabled='disabled'>
				</td>";

		if($checkApplied===false){
			echo "<td><button type='submit' class='btn btn-default'>Apply</button></td></tr></form>";
		}
		else{
			echo "<td>Applied</td></tr></form>";
		}

	}

	echo "</table>";
}

?>