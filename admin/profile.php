<?php
// error_reporting(0);
session_start();

// Include config file
require_once "./../config.php";


// Attempt select query execution
$sql = "SELECT * FROM admin WHERE username = 'admin'";
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
        }
        // Free result set
        mysqli_free_result($result);
    } else {
        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nameups = $_POST['name'];
    // $usernameups = $_POST['username'];
    $emailups = $_POST['email'];
    $phoneups = $_POST['phone'];
    $pswdup = $_POST['pswd'];
    $pswdups = md5($_POST['pswd']);

    if (empty($pswdup)) {
        $sql = "UPDATE admin SET name = '{$nameups}', email = '{$emailups}', phone = '{$phoneups}' WHERE username = 'admin'";

        if (mysqli_query($conn, $sql)) {
            echo " record updated created successfully";
            header("Location: profile.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        // echo 'form value came is empty '.$_POST['pswd'].'<br>';
        // echo '$pswdup in if'.$pswdup.'<br>';
        // echo '$pswdups md5 '.$pswdups.'<br>';
    } else if (!empty($pswdup)) {
        $sql = "UPDATE admin SET name = '{$nameups}', email = '{$emailups}', phone = '{$phoneups}', pswd = '{$pswdups}' WHERE username = 'admin'";

        if (mysqli_query($conn, $sql)) {
            echo " record updated created successfully";
            header("Location: profile.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }




    exit();
}


if ($_SESSION['sessionadmin'] == true && (time() - $_SESSION['logintimeadmin'] < 1800)) {
    $_SESSION['logintimeadmin'] = time();
    echo '<!DOCTYPE html>
        <html lang="en">
        
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!-- Google Font API spartan -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
            <!-- Custom CSS -->
            <!-- <link rel="stylesheet" href="./../assets/styles/index.css"> -->
            <!-- Custom JS if any -->
            <!-- <script src="assets/js/script1.js"></script> -->
            <title>Document</title>
        </head>
        
        <body>
        
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand"><img src="./../assets/imgs/logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" style="font-weight: 700;" href="modview.php">MODERATORS <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" style="font-weight: 700;" href="userview.php">USERS <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" style="font-weight: 700;" href="productview.php">PRODUCTS <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" style="font-weight: 700;" href="saleview.php">SALES <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <ul class="navbar-nav mr-auto">
        
                            <li class="nav-item active">
                                <a class="nav-link" style="font-weight: 700;" href="logout.php">LOGOUT<span class="sr-only">(current)</span></a>
                            </li>
                            
        
                        </ul>
                    </form>
                </div>
            </nav>
            <section>
            <form action="" method = "post">
            <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-4 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">' . $name . '</span><span class="text-black-50">' . $email . '</span><span> </span></div>
                </div>
    <div class="col-md-8 border-right">
        <div class="p-3 py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Profile Settings</h4>
            </div>
            <div class="row mt-3">
                <div class="col-md-12"><label class="labels">Full Name</label><input type="text" class="form-control" name="name" value="' . $name . '"></div>
                <div class="col-md-12"><label class="labels">Password</label><input type="password" class="form-control" value="" name="pswd" placeholder="*********"></div>
                <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" name = "email" value="' . $email . '"></div>
                <div class="col-md-12"><label class="labels">Phone</label><input type="text" class="form-control" name="phone" value="' . $phone . '"></div>
            </div>
            <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
        </div>
    </div>
</div>
</div>
</div>
</div>
            </form>
            </section>
            <!-- JS Popper Bootstrap -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
            </script>
        
        </body>
        
        </html>';
} else {
    session_destroy();
    echo '<br><br><br><br><br>';
    echo '<h1 style = "text-align: center; justify-content: center; ">Session Expired.</h1>';
    echo '<h1 style = "text-align: center; justify-content: center; ">Login again to continue.</h1>';
}
