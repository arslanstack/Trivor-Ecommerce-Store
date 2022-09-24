<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['generate'])) {
    require 'config.php';
    echo $_SESSION['userid'] . ' session username';
    echo $_SESSION['usermail'] . ' session email';
    echo $_SESSION['username'] . ' session full name';
    $username = $_SESSION['userid'];
    $name = $_SESSION['username'];
    $email = $_SESSION['usermail'];
    echo $username . ' variable username';
    echo $name . ' variable name';
    echo $email . 'variable email';
    $token = bin2hex(random_bytes(15));
    $_SESSION['vpin'] = mt_rand(1000, 9999);
    $vpin = md5($_SESSION['vpin']);
    echo $token;
    $sql = "UPDATE userdata SET token = '$token', vpin = '$vpin' WHERE email = '$email'";
    if ($result = mysqli_query($conn, $sql)) {
        echo "Token Generated";

        require 'activationmail.php';
        mailed($email, $username, $name, $token);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
    <link rel="stylesheet" href="">
</head>

<body>
<section class="container-fluid topsection" id="topsec">
        <nav class="navbar navbar-expand-lg navbar-light" id="topnav">
            <a class="navbar-brand pt-0" id="brand" href="#"><img src="assets/imgs/logo.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">HOME <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="shop.php">SHOP<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">ABOUT US <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="#">CONTACT <span class="sr-only">(current)</span></a>
                    </li>

                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item active">
                            <a class="nav-link" <?php if($_SESSION['userid']){echo 'href="./profile.php">PROFILE';} else{echo 'href="./login.php">LOGIN ';} ?><span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" <?php if($_SESSION['userid']){echo 'href="./logout.php">LOGOUT';} else{echo 'href="./signup.php">SIGNUP ';} ?><span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link btn btn-outline-light" id="topbtn" href="cart.php"><svg width="29" height="29"
                                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.586 17.586a2 2 0 1 1 2.828 2.828 2 2 0 0 1-2.828-2.828Z"></path>
                                    <path d="M8.414 20.414a2 2 0 1 0-2.828-2.828 2 2 0 0 0 2.828 2.828Z"></path>
                                    <path d="m7 13-2.293 2.293c-.63.63-.184 1.707.707 1.707H17"></path>
                                    <path d="M5.4 5H21l-4 8H7L5.4 5Z"></path>
                                    <path d="M3 3h2l.4 2"></path>
                                </svg><span class="sr-only">(current)</span></a>
                        </li>

                    </ul>
                </form>
            </div>
        </nav>
</section>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 text-center">
                <h1 class="display-4">Please activate your account.</h1>
                <br>
                <form action="" method="post">
                    <input type="text" name="generate" class="d-none">
                    <input type="submit" value="Generate Activation Link" class="btn btn-dark text-white">
                </form>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

    <!-- JS Popper Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>