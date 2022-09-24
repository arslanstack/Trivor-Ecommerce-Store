<?php
session_start();
$vpin = $_SESSION['change'];
if (isset($_POST['pswd'])) {
    require 'config.php';
    
    $pswd = md5($_POST['pswd']);
    $sql = "UPDATE userdata SET status = 'active', pswd = '{$pswd}', token = 'nill' WHERE vpin = '{$vpin}'";
    if ($result = mysqli_query($conn, $sql)) {
        header("Location: login.php");
    } else {
        echo '<h1 class="display-4 text-center">There is some problem at our end, sorry for inconvenience</h1>';
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
    <br><br><br><br>
    <div class="card login-form">
        <div class="card-body">
            <h3 class="card-title text-center">Reset password</h3>

            <div class="card-text">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter new password.</label>
                        <input type="password" name="pswd" class="form-control form-control-sm" placeholder="Enter new password">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
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