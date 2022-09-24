<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Trivor Cara</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="">
</head>

<body>


    <?php
    session_start();
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    if (isset($_GET['token'])) {
        require 'config.php';
        
        $sql = "SELECT token, status, timestamp FROM userdata WHERE token = '{$token}'";
        if ($result = mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $_SESSION['activating'] = $row['token'];
                if ($row['status'] = 'Inactive') {
                    date_default_timezone_set("Asia/Karachi");
                    $date = date('Y-m-d H:i:s', time());
                    $diff = strtotime($date) - strtotime($row['timestamp']);
                    if ($diff > 180) {
                        echo '<h1 class="display-4 text-center">Link expired, please generate new link</h1>';
                    }
                    else{
                        header("Location: refac.php");
                    }
                }
                else {
                    echo '<h1 class="display-4 text-center">Link already used to reset password, Please Generate new one.</h1>';
                }
            }
            else {
                echo '<h1 class="display-4 text-center">[ERROR] Invalid Link, <br> Link may be broken or already used.</h1> <br>';
                
            }
        }

    }
}

?>




    <!-- JS Popper Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>