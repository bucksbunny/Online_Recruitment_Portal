<?php
session_start();

if(!isset($_SESSION["rec_logged_in"])){
	session_destroy();
	header("Location: /");
}

?>