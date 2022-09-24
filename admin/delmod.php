<?php
session_start();
// echo $_SESSION['delee'];
// Include config file
require_once "./../config.php";

$sql = "SELECT * FROM moderator WHERE username = '{$_SESSION['delee']}'";
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $email = $row['email'];
        $sql = "DELETE FROM moderator WHERE username = '{$_SESSION['delee']}'";
        if ($result = mysqli_query($conn, $sql)) {
            echo "Deleted Successfully";
            $sql = "DELETE FROM attempt2 WHERE email = '{$email}'";
            if ($result = mysqli_query($conn, $sql)) {
                echo "Deleted Successfully 2";
            }
        } else {
            echo '<div class="alert alert-danger"><em>Error occured</em></div>';
        }
        header("Location: modview.php");
        exit();
    }
}




?>
