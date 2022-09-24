<?php
session_start();
if (isset($_POST['username'])) {
    require './../config.php';
    $username = $_POST['username'];
    $pswd = md5($_POST['pswd']);
    $sql = "SELECT username,email,pswd,status,token,name FROM moderator WHERE username = '{$username}'";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $dbpswd = $row['pswd'];
            $dbstatus = $row['status'];
            $dbemail = $row['email'];
            $dbtoken = $row['token'];
            $dbname = $row['name'];
            if ($pswd == $dbpswd) {
                echo "Correct Password";
                $sql = "SELECT state FROM attempt2 WHERE email = '{$dbemail}'";
                if ($result = mysqli_query($conn, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_array($result);
                        if ($row['state'] == 'frozen') {
                            echo "Redirect to frozen page";
                            header("Location: frozen.php");
                        } else {
                            //login successful
                            $sql = "UPDATE attempt2 SET attempt = 0 WHERE email = '{$dbemail}'";
                            if ($result = mysqli_query($conn, $sql)) {
                                $_SESSION['sessionmod'] = true;
                                $_SESSION['logintimemod'] = time();
                                $_SESSION['modid'] = $username;
                                $_SESSION['modmail'] = $dbemail;
                                $_SESSION['modname'] = $dbname;
                                echo "Not frozen moving on to round check status";
                                if ($dbstatus == 'active') {
                                    echo "redirected to profile page";
                                    header("Location: profile.php");
                                } else {
                                    echo "redirect to frozen page";
                                    header("Location: frozen.php");
                                }
                            }
                            // 

                        }
                    }
                }
            } else {
                echo "Incorrect Password";
                $sql = "SELECT attempt FROM attempt2 WHERE email = '{$dbemail}'";
                if ($result = mysqli_query($conn, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_array($result);
                        if ($row['attempt'] == 2) {
                            $sql = "UPDATE attempt2 SET state = 'frozen' WHERE email = '{$dbemail}'";
                            if ($result = mysqli_query($conn, $sql)) {
                                $sectoken  = bin2hex(random_bytes(15));
                                $sql = "UPDATE moderator SET status = 'Inactive' WHERE email = '{$dbemail}'";
                                if ($result = mysqli_query($conn, $sql)) {
                                    // require './../freezemail.php';
                                    // mailed($dbemail, $username, $dbname, $sectoken);
                                }
                            }
                            echo "Frozen";
                        } else {
                            echo " Not frozen yet";
                        }
                    } else {
                        echo "Error 1";
                    }
                } else {
                    echo "Error 2";
                }
                $sql = "UPDATE attempt2 SET attempt = ((SELECT attempt FROM attempt2 WHERE email = '{$dbemail}')+1) WHERE email = '{$dbemail}'";
                if ($result = mysqli_query($conn, $sql)) {
                    echo "Attempt added";
                }
                $_SESSION['loginerror'] = "Incorrect Password";
                header("Location: index.php");
            }
        } else {
            echo "Invalid Username";
            $_SESSION['loginerror'] = "Username doesn't exists";
            header("Location: index.php");
        }
    }
}

?>



<!DOCTYPE html>
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
    <link rel="stylesheet" href="./../assets/styles/index.css">
    <!-- Custom JS if any -->
    <!-- <script src="assets/js/script1.js"></script> -->
    <title>Document</title>
</head>

<body>

    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border: none;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="./../assets/imgs/kuri.webp" alt="login form" class="img-fluid" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3"></i>
                                            <span class="h1 fw-bold mb-0"><img src="./../assets/imgs/logo.png"></span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your
                                            account</h5>

                                        <div class="form-outline mb-4">
                                            <input type="text" id="form2Example17" class="form-control form-control-lg" name="username" placeholder="Username" required>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="form2Example27" class="form-control form-control-lg" name="pswd" placeholder="Password" required>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                        </div>

                                        <!-- <a class="small text-muted" href="forgot.php">Forgot password?</a> -->
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Not a moderator? <a href="./../login.php" style="color: #393f81;">Go back</a></p>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JS Popper Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

</body>

</html>