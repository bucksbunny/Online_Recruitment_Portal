<?php

session_start();

unset($_SESSION['is_logged_in']);
unset($_SESSION['rec_logged_in']);
unset($_SESSION['uname']);
unset($_SESSION['pass']);
unset($_SESSION['companyName']);

session_destroy();

header("Location: index.php");

?>