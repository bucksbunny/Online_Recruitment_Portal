<?php

$uname = $fname = $lname = $email = $dob = $name = $mobNum = "";
$city = $state = $pinCode = $resumeLink = "";
$unameErr = $fnameErr = $lnameErr = $emailErr = $dobErr = $nameErr = $mobNumErr = "";
//No need for these - $cityErr = $stateErr = $pinCodeErr = $resumeLinkErr = "";

$corr_flag = 1;

$servername = "localhost";
$username = "guestuser";
$password = "guestuser";
$database = "login";

$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error){
    //	To be changed
    die("Connection Error : ".$conn->connect_error);
}

if($_SERVER['REQUEST_METHOD']=="POST"){

	//	Test Username

	//	Test First Name
	if(empty($_POST['f_name'])){
		$fnameErr="Please Enter a First Name";
		$corr_flag = 0;
	}
	else{
		$fname = testInput($_POST['f_name']);
	}

	//	Test Last Name
	if(empty($_POST['l_name'])){
		$lnameErr="Please Enter a Last Name";
		$corr_flag = 0;
	}
	else{
		$lname = testInput($_POST['l_name']);
	}

	//	Test Email
	if(empty($_POST['email_id'])){
		$emailErr="Please Enter an Email ID";
		$corr_flag = 0;
	}
	else{
		$email = testInput($_POST['email_id']);
	}

	//	Test Mobile
	if(empty($_POST['mob_num'])){
		$mobNumErr="Please Enter a Mobile Number";
		$corr_flag = 0;
	}
	elseif(strlen($_POST['mob_num'])!=10 || !preg_match('/^[0-9]{10}$/', $_POST['mob_num'])){
		$mobNumErr="Please Enter a Valid Mobile Number";
		$corr_flag = 0;
	}
	else{
		$mobNum = testInput($_POST['mob_num']);
	}

	// Date of Birth
	if(empty($_POST['date_of_birth'])){
		$dobErr="Please Enter a Date of Birth";
		$corr_flag = 0;
	}
	elseif (!validateDate($_POST["date_of_birth"])) {
		$dobErr="Invalid Date";
		$corr_flag = 0;
	}
	else{
		$dob = testInput($_POST['date_of_birth']);
	}


	// City is optional. No need to test
	$city = testInput($_POST['city']);
	// State is optional. No need to test
	$state = testInput($_POST['state']);

	// Pin Code is optional. No need to test for emptiness
	// Test Pin Code
	if(empty($_POST["pin_code"])){
		//Do nothing if it is empty.
		$pinCode = testInput($_POST['pin_code']);
	}
	else if(strlen($_POST["pin_code"])!=6 || !preg_match('/^[0-9]{6}$/', $_POST["pin_code"])){
		$pinCodeErr="Please Enter a Valid Pin Number";
		$corr_flag = 0;
	}
	else{
		$pinCode = testInput($_POST['pin_code']);
	}

	//	No need to check resume link.
	$resumeLink = testInput($_POST['resume_link']);


/*	Data Validation Complete.
 *	If there's no error, then create the account and log the user in
 */

	if($corr_flag == 1){

		/*
		$sql_insert_applicants = "INSERT INTO login.applicants(f_name, l_name, email_id, mob_num, date_of_birth, city,
									state, pin_code, resume_link)

								VALUES('".$fname."', '".$lname."', '".$email."', '".$mobNum."', '".$dob."', '".$city."', '".$state."', '".$pinCode."', '".$resumeLink"');";
					
		
		*/

		
	//		die($pinCode);

		
		$sql_update_applicants = "UPDATE applicants 
									SET f_name='".$fname."', l_name='".$lname."', email_id='".$email."', 
									mob_num='".$mobNum."', date_of_birth='".$dob."', city='".$city."', 
									state='".$state."', pin_code='".$pinCode."', resume_link='".$resumeLink."' 
									WHERE username='".$_SESSION['uname']."';";

		/*
									SET f_name='".$fname."', l_name='".$lname."', email_id='".$email."', 
									mob_num='".$mobNum."', date_of_birth='".$dob."', city='".$city.", 
									state='".$state."', pin_code='".$pinCode."', resume_link='".$resumeLink."' 
									WHERE username='"."admin"."';";*/

		if($conn->query($sql_update_applicants) == TRUE){
			echo "YAY! for update";
		}
		else{
			echo $sql_update_applicants." ".$conn->error;
		}
		

   		header("Location: /userEditDetails.php");
		
	}
}


function validateDate($date){
	$d = DateTime::createFromFormat('Y-m-d', $date);
	return $d && $d->format('Y-m-d')===$date;
}

function testInput($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>