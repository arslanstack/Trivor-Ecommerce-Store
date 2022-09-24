<?php 
session_start();
// echo $_SESSION['delee'];
// Include config file
require_once "./../config.php";


// Attempt select query execution
$sql = "DELETE FROM product WHERE prodid = '{$_SESSION['delee']}'";
if ($result = mysqli_query($conn, $sql)) {
        echo "Deleted Successfully";
    }
    else {
        echo '<div class="alert alert-danger"><em>Error occured</em></div>';
    }
    header("Location: productview.php");
    exit();

?>