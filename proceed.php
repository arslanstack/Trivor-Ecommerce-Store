<?php 
    session_start();

    if($_SESSION['userid']){
        header("Location: orderstageone.php");
    }
    else{
        header("Location: login.php");
    }
?>
