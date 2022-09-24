<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Rakaposhi</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/styles/2fac.css">
</head>

<body>
    <br><br>
    <?php
    session_start();
    if (isset($_POST['code'])) {
        require 'config.php';

        // echo "Reached here";
        $code = $_POST['code'];
        $token = $_SESSION['activating'];
        $sql = "SELECT vpin FROM userdata WHERE token = '{$token}'";
        if ($result = mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                // echo "db = " . $row['vpin'];
                // echo "entered code = " . $code . "<br>";
                // echo "entered code type = " . gettype($code) . "<br>";
                // echo "entered code md5 = " . md5($code);
                if ($row['vpin'] == md5($code)) {
                    $_SESSION['change'] = md5($code);
                    header("Location: newpass.php");
                } else {
                    echo "vpin not match";
                }
            } else {
                echo "No reccord found";
            }
        } else {
            echo "Error Query or Connection";
        }
    }




    ?>
    <br><br>
    <div class="container">
        <h1 class="display-4 text-center">Please enter your secure verification pin</h1>
        <br>
        <p class="lead text-center">Your entered token is valid, account will be activated when you enter your <em>4-digit</em> verifiction security code</p>
    </div>
    <br><br>
    <div class="conatiner">
        <form action="" method="post">
            <div class="row mx-auto" style="justify-content: center;">
                <div class="pinBox" style="justify-content: center;">
                    <input class="pinEntry" name="code" type="text" maxlength=4 autocomplete=off>
                </div>
            </div>
            <br>
            <div class="row mx-auto" style="justify-content: center;">
                <div class="mt-4 "> <button type="submit" class="btn btn-dark  px-4 validate">Validate</button> </div>
            </div>
    </div>
    </form>
    </div>
    <br><br>
    <!-- <div class="container  text-center">
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