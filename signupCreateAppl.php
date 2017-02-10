<?php

session_start();

if(isset($_SESSION["is_logged_in"]) || /*this is new for rec*/isset($_SESSION["rec_logged_in"])){
	header("Location: /");
}
else{
	session_destroy();
}

$uname = $pass = $confirm_pass = $fname = $lname = $email = $dob = $name = $mobNum = "";
$unameErr = $passErr = $confirm_passErr = $fnameErr = $lnameErr = $emailErr = $dobErr = $nameErr = $mobNumErr = "";

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
	if(empty($_POST['username'])){
		$unameErr="Please Enter a Username";
		$corr_flag = 0;
	}
	else{
		$uname = testInput($_POST['username']);
		$uname = preg_replace('/\s+/', '', $uname);

		//	Check if username already exists or not
		$sql_username_check = "SELECT * FROM login_details WHERE username='".$uname."';";
		if(($conn->query($sql_username_check))->num_rows != 0){
			$uname="";
			$unameErr = "Username Already Exists";
			$corr_flag = 0;
		}
	}

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

	//	Test Password
	if(empty($_POST['password'])){
		$passErr="Please Enter a Password";
		$corr_flag = 0;
	}
	else{
		$pass = testInput($_POST['password']);

		//	Check if password already exists or not
		$sql_password_check = "SELECT * FROM login_details WHERE password='".$pass."';";
		if(($conn->query($sql_password_check))->num_rows != 0){
			$pass="";
			$passErr = "Password Already Exists";
			$corr_flag = 0;
		}
	}

	//	Test Confirm Password
	if(empty($_POST['confirm_pass'])  || $_POST['password'] != $_POST['confirm_pass']){
		$confirm_passErr="Passwords Don't match";
		$pass = "";
		$corr_flag = 0;
	}
	else{
		$confirm_pass = testInput($_POST['confirm_pass']);
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

/*	Data Validation Complete.
 *	If there's no error, then create the account and log the user in
 */

	if($corr_flag == 1){

		session_start();

		$sql_insert_login_details = "INSERT INTO login.login_details VALUES('".$uname."', '".$pass."');";
		$sql_insert_applicants = "INSERT INTO login.applicants(username, f_name, l_name, email_id, mob_num, date_of_birth)
								VALUES('".$uname."', '".$fname."', '".$lname."', '".$email."', '".$mobNum."', '".$dob."');";
								
		//INSERT into login.applicants(username, f_name, l_name, email_id, mob_num, date_of_birth)
		//VALUES('admin', 'Trail', 'asda', 'asda', '1203971', '1993-12-14');
	
		if($conn->query($sql_insert_login_details) == TRUE){
			echo "YAY for login!";
		}
		else{
			echo $sql_insert_login_details." ".$conn->error;
		}

		if($conn->query($sql_insert_applicants) == TRUE){
			echo "YAY! for applicant";
		}
		else{
			echo $sql_insert_login_details." ".$conn->error;
		}
		
	//Set Session Values
        if(!isset($_SESSION["is_logged_in"])){
       		$_SESSION["is_logged_in"] = 1;
       	}

       	if(!isset($_SESSION['uname'])){
       		$_SESSION['uname'] = $uname;	
       	}

       	if(!isset($_SESSION['pass'])){
       		$_SESSION['pass'] = $pass;	
       	}

   		header("Location: /userHome.php");

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