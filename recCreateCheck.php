<?php

$jobName = $jobSalary = $jobProfile = "";
$jobNameErr = $jobSalaryErr = $jobProfileErr = "";

$corr_flag = 1;

if($_SERVER['REQUEST_METHOD']=='POST'){

	if(empty($_POST['job_name'])){
		$jobNameErr="Please Enter a Job Name";
		$corr_flag = 0;
	}
	else{
		$jobName = testInput($_POST['job_name']);
	}

	if(empty($_POST['job_profile'])){
		$jobProfileErr="Please Enter a Job Profile";
		$corr_flag = 0;
	}
	else{
		$jobProfile = testInput($_POST['job_profile']);
	}


	if(empty($_POST['job_salary'])){
		$jobSalaryErr="Please Enter a Salary";
		$corr_flag = 0;
	}
	else{
		$jobSalary = testInput($_POST['job_salary']);
	}

	//	Now, if evrything is alright, then all cool
	if($corr_flag==1){


		$sql = "INSERT INTO Applications (job_name, job_profile, job_create_date,  job_salary, recruiter_uname)
				VALUES ('".$jobName."', '".$jobProfile."', CURRENT_TIMESTAMP , '".$jobSalary."', '".$_SESSION['uname']."');";

		if($conn->query($sql) == TRUE){
			echo "GREAT!";
			header("Location: recHome.php");
		}
		else{
			die($conn->conn_error);
		}
	}


}


function testInput($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


?>