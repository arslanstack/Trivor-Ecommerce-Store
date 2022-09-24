<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'config.php';
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    $sql = "SELECT email, username, name FROM userdata WHERE email = '$email'";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            // echo "Record Exists";
            $row = mysqli_fetch_array($result);
            $name = $row['name'];
            $username = $row['username'];
            $token = bin2hex(random_bytes(15));
            $_SESSION['vpin'] = mt_rand(1000, 9999);
            $vpin = md5($_SESSION['vpin']);
            // echo $token;
            // echo $name;
            // echo $username;
            // echo $email;
            $sql = "UPDATE userdata SET token = '$token', status = 'Inactive', vpin = '$vpin' WHERE email = '$email'";
            if ($result = mysqli_query($conn, $sql)) {
                // echo "Token Generated";

                //Import PHPMailer classes into the global namespace
                //These must be at the top of your script, not inside a function

                require 'forgotmail.php';
                mailed($email, $username, $name, $token);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Record Doesn't Exists";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Trivor Cara</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/styles/forgot.css">
</head>

<body>


    <div class="card login-form">
        <div class="card-body">
            <h3 class="card-title text-center">Reset password</h3>

            <div class="card-text">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter your email address and we will send you a link to reset
                            your password.</label>
                        <input type="email" name="email" class="form-control form-control-sm" placeholder="Enter your email address">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Send password reset email</button>
                </form>
            </div>
        </div>
    </div>




    <!-- JS Popper Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>