<?php 
session_start();
session_destroy();
// $_SESSION['msg'] = "Logged out successfuly!";
header("Location: login.php");

?>