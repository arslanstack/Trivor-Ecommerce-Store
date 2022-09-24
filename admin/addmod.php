<?php
// error_reporting(0);
session_start();
if (isset($_POST['username'])) {
    require './../config.php';

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pswd = mysqli_real_escape_string($conn, md5($_POST['pswd']));
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    // $_SESSION['timezone'] = date_default_timezone_get();
    $token = bin2hex(random_bytes(15));
    $status = "active";
    $_SESSION['vpin'] = mt_rand(1000, 9999);
    $vpin = md5($_SESSION['vpin']);

    $sql = "SELECT email FROM moderator WHERE email = '{$email}'";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['signuperror'] = "Email Already Exists";
            header("Location: addmodagain.php");
        } else {
            $sql = "SELECT username FROM userdata WHERE username = '{$username}'";
            if ($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    $_SESSION['signuperror'] = "Username Already Exists";
                    header("Location: addmodagain.php");
                } else {

                    $sql = "INSERT INTO moderator (username, pswd, name, email,  phone, token, status, vpin)
              VALUES ('{$username}', '{$pswd}', '{$name}', '{$email}', '{$phone}', '{$token}', '{$status}', '{$vpin}')";

                    if (mysqli_query($conn, $sql)) {
                        $sql = "INSERT INTO attempt2 (email, attempt, state) VALUES ('{$email}','0','normal')";
                        if (mysqli_query($conn, $sql)) {
                            // echo "New record created successfully";
                            header("Location: modview.php");
                        } else {
                            // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            header("Location: modview.php");
                        }
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
            } else {
                echo "Email fetching error";
            }
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }

    // mysqli_close($conn);
    // header("Location: index.php");

}

if($_SESSION['sessionadmin'] == true && (time() - $_SESSION['logintimeadmin'] < 300)){
    $_SESSION['logintimeadmin'] = time();
    echo '
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="style1.css" rel="stylesheet">
        <title></title>
    </head>
    
    <body>
        <br>
        <h1 class="display-4 text-center">Add Moderator Record</h1>
        <br>
    
    
        <div class="container">
            <div class="row">
                <section class="vh-100">
                    <div class="container h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-lg-12 col-xl-11">
                                <div class="card text-black" style="border-radius: 25px;">
                                    <div class="card-body p-md-5">
                                        <div class="row justify-content-center">
                                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
    
                                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Add Moderator</p>
    
                                                <form class="mx-1 mx-md-4" action="" method="post">
    
                                                    <div class="d-flex flex-row align-items-center mb-4">
                                                        <div class="form-outline flex-fill mb-0">
                                                            <input type="text" id="form3Example1c" class="form-control" placeholder="Username" name="username" required>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-row align-items-center mb-4">
                                                        <div class="form-outline flex-fill mb-0">
                                                            <input type="password" id="form3Example1c" class="form-control" placeholder="Password" name="pswd" required>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-row align-items-center mb-4">
                                                        <div class="form-outline flex-fill mb-0">
                                                            <input type="text" id="form3Example1c" class="form-control" placeholder="Full Name" name="name" required>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-row align-items-center mb-4">
                                                        <div class="form-outline flex-fill mb-0">
                                                            <input type="email" id="form3Example1c" class="form-control" placeholder="Email" name="email" required>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-row align-items-center mb-4">
                                                        <div class="form-outline flex-fill mb-0">
                                                            <input type="phone" id="form3Example1c" class="form-control" placeholder="Phone" name="phone" required>
                                                        </div>
                                                    </div>
    
                                                    <div class="">
                                                        <button type="submit" class="btn btn-primary">Add User</button>
                                                        <a href="modview.php" class="btn btn-dark">Go Back</a>
                                                    </div>
                                                    <br>
    
                                                </form>
    
    
                                            </div>
                                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
    
                                                <img src="./../assets/imgs/cover2.webp" class="img-fluid" alt="Sample image">
    
    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <br><br><br><br>
            </div>
        </div>
        <!-- JS Popper Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
    
    </html>';
}
else{
    session_destroy();
        echo '<br><br><br><br><br>';
        echo '<h1 style = "text-align: center; justify-content: center; ">Session Expired.</h1>';
        echo '<h1 style = "text-align: center; justify-content: center; ">Login again to continue.</h1>';
}
?>

