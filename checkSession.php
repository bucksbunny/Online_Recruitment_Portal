<?php
session_start();

if(!isset($_SESSION["is_logged_in"])){
	session_destroy();
	header("Location: /");
}

?>