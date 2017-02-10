<?php

	$uname = $pass = "";
	$error_msg = "";

	$correction_flag = 1;

if($_SERVER["REQUEST_METHOD"]=="POST"){

	if(empty($_POST["username"])){
		$correction_flag = 0;
		$error_msg = "Please fill in Username/Password";
	}
	else{
		$uname = testInput($_POST["username"]);
	}
	
	if(empty($_POST["pass"])){
		$correction_flag = 0;
		$error_msg = "Please fill in Username/Password";
	}
	else{
		$pass = testInput($_POST["pass"]);	
	}
	
	//	If data is entered, fetch data from database
	if($correction_flag == 1){
		
		$servername = "localhost";
    	$username = "guestuser";
    	$password = "guestuser";
    	$database = "login";

    	$conn = new mysqli($servername, $username, $password, $database);

    	if($conn->connect_error){
    		//	To be changed
     		die("Connection Error : ".$conn->connect_error);
    	}


    	$sql = "SELECT * FROM login_details WHERE username='".$uname."' AND password='".$pass."';";
    	$result_login = $conn->query($sql);


    	if($result_login->num_rows == 1){
        	//	Start Session
        	session_start();

        	$sql_user = "SELECT * FROM applicants WHERE username='".$uname."'";
        	//$sql_rec = "SELECT * FROM recruiters WHERE username='".$uname."'";
        	
        	if(($conn->query($sql_user))->num_rows == 1){

        		//Set Session Values for applicant
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

        	else{

        		//Set Session Values for recruiter
        		if(!isset($_SESSION["rec_logged_in"])){
        			$_SESSION["rec_logged_in"] = 1;
        		}

        		if(!isset($_SESSION['uname'])){
	        		$_SESSION['uname'] = $uname;
        		}

        		if(!isset($_SESSION['pass'])){
        			$_SESSION['pass'] = $pass;
        		}

    			header("Location: /recHome.php");
        	}   	
	  	}
    	else{
    		$error_msg = "Invalid Username/Password combination";
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