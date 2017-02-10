<!--

This file is probably not used anywhere. Just a template i made for connections.

-->
<?php

$uname = $_SESSION["uname"];
$servername = "localhost";
$username = "guestuser";
$password = "guestuser";
$database = "login";


$conn = new myqli($servername, $username, $password, $database);

if($conn->connect_error){
	//	To be changed
	die("Connection Error : ".$conn->connect_error);
}

$sql = "SELECT username, f_name, l_name FROM applicants WHERE username ='".$uname."';";

$result_query = $conn->query($sql);

if($result_query->num_rows != 1){
	die("Data Fetch Error. Please Try Again.");
}

while($row = $result_query->fetch_assoc()){
	$applDataArray = array('uname' => $row["username"], 'f_name' => $row['f_name'], 'l_name' => $row['l_name']);
}

?>