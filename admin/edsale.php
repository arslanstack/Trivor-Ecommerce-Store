<?php

session_start();


// Include config file
require_once "./../config.php";


// Attempt select query execution
$sql = "SELECT * FROM sales WHERE orderno = '{$_SESSION['editee']}'";
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $status = $row['status'];
            if ($status == 'completed') {
                $sql = "UPDATE sales SET status = 'delivered' WHERE orderno = '{$_SESSION['editee']}'";
                if (mysqli_query($conn, $sql)) {
                    echo " record updated created successfully";
                    header("Location: saleview.php");
                }
            } else if ($status == 'delivered') {
                // $sql = "UPDATE sales SET status = 'processing' WHERE orderno = '{$_SESSION['editee']}'";
                // if (mysqli_query($conn, $sql)) {
                //     echo " record updated created successfully";
                    header("Location: saleview.php");
                // }
            }
        }
        // Free result set
        mysqli_free_result($result);
    } else {
        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
    }
} else {
    echo "Oops! Something went wrong. Please try again later.";
}
