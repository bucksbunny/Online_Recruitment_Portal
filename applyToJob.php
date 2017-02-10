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


if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$sql_check = "SELECT * FROM applicant_applications
					WHERE job_id='".$_POST['job_id']."'
					AND applicant_uname = '".$_SESSION['uname']."';";

	if(($conn->query($sql_check))->num_rows != 0 ){
		$checked = false;
	}
	else{
		$checked = true;
	}
	
	if($checked){
		
		$sql_insert = "INSERT INTO applicant_applications (job_id, applicant_uname)
					VALUES('".$_POST['job_id']."', '".$_SESSION['uname']."');";

		if(($conn->query($sql_insert)) == TRUE){
			echo "alert(".$_SESSION['prev_search'].")";
			header("Location: ".$_SESSION['prev_search']);
		}
		else{
			header("Location: userHome.php");
		}
	}
	else{
		header("Location: ".$_SESSION['prev_search']);
	}
	
}

?>