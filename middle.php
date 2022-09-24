<?php
session_start();
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
    <link rel="stylesheet" href="app.css">
</head>

<body>
    <br><br>
<div class="container  text-center">
        <div class="row text-center">
            <div class="col-md-6 mx-auto">
            <br><br>
    <h1 class="display-4 text center">Verification link sent at your email address</h1>
    <br><br>
    <h1 class="display-2 text center "><?php echo $_SESSION['vpin'] ?></h1>
    <br><br>
    <p class="lead font-weight-bold text-center">Please save this verification pin it will be asked for activation.</p>
    <br>
    <p class="lead text-center"><a href="login.php"> Click Here to close this page </a>or page will automatically redirect in 1 minute.</p>
            </div>
        </div>
    </div>
    <?php 
        header( "refresh:60;url=login.php" );

    ?>

    <!-- <br><br>
    <div class="container  text-center">
        <div class="row text-center">
            <div class="col-md-6 mx-auto">
                <a href="login.php" class="btn btn-success">Redirect to Login page</a>
            </div>
        </div>
    </div> -->

    <!-- JS Popper Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>