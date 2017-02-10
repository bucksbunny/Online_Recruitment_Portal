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


if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$sql_check = "SELECT * FROM applicant_applications
					WHERE job_id='".$_POST['job_id']."'
					AND applicant_uname = '".$_POST['applicant_uname']."'
					AND appl_status='Waiting';";

	if(($conn->query($sql_check))->num_rows == 1 ){
		$checked = true;
	}
	else{
		$checked = false;
	}
	
	if($checked){

		if(isset($_POST['accept'])){
			
			$sql_update = "UPDATE applicant_applications
							SET appl_status = 'Accepted'
							WHERE applicant_uname = '".$_POST['applicant_uname']."'
							AND job_id = '".$_POST['job_id']."';";

			if(($conn->query($sql_update)) == TRUE){
				header("Location: recViewAppl.php");
			}
			else{
				header("Location: recHome.php");
			}

		}
		elseif(isset($_POST['reject'])){
			
			$sql_update = "UPDATE applicant_applications
							SET appl_status = 'Rejected'
							WHERE applicant_uname = '".$_POST['applicant_uname']."'
							AND job_id = '".$_POST['job_id']."';";

			if(($conn->query($sql_update)) == TRUE){
				header("Location: recViewAppl.php");
			}
			else{
				header("Location: recHome.php");
			}
		}
	}
	
	else{
		header("Location: recHome.php");
	}
	
}

?>