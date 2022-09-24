<?php

session_start();


// Include config file
require_once "./../config.php";


// Attempt select query execution
$sql = "SELECT * FROM moderator WHERE username = '{$_SESSION['editee']}'";
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $name = $row['name'];
            $username = $row['username'];
            $email = $row['email'];
            $phone = $row['phone'];
            $status = $row['status'];
            // echo $username;
            // echo $fname;
            // echo $lname;
            // echo $id;
        }
        // Free result set
        mysqli_free_result($result);

    }
    else {
        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
    }
}
else {
    echo "Oops! Something went wrong. Please try again later.";
}



if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nameups = $_POST['name'];
    $usernameups = $_POST['username'];
    $emailups = $_POST['email'];
    $phoneups = $_POST['phone'];
    $statusups = $_POST['status'];
   
$sql = "UPDATE moderator SET name = '{$nameups}', username = '{$usernameups}', email = '{$emailups}', phone = '{$phoneups}', status = '{$statusups}' WHERE username = '{$username}'";

if (mysqli_query($conn, $sql)) {
  echo " record updated created successfully";
  header("Location: modview.php");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


exit();
}




if(isset($_POST['canceler'])){
    header("Location: modview.php");
exit();
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link href="style1.css" rel="stylesheet">
<title>Edit Details</title>
</head>

<body>
<br>
<h1 class="display-4 text-center">Update User Record</h1>
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" id="contains">
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" id="name" name="name" class="form-control" value = "'. $name .'">
                    </div>
                    <div class="col-md-5">
                        <input type="text" id="username" name="username" readonly class="form-control" value = "'. $username .'">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" id="email" name="email" class="form-control"
                           value = "'. $email .'" >
                    </div>
                    <div class="col-md-5">
                        <input type="text" id="phone" name="phone" class="form-control" value = "'. $phone .'">
                    </div>
                </div>
                <br>
                
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" id="status" name="status" class="form-control" value = "'. $status .'">
                    </div>
                    
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <input type="submit" value="Update Record" class="btn btn-success">
                        <form action="">
                            <input type="text" class="d-none" name = "canceler">
                            <a href="javascript:history.back()" class="btn btn-dark">Cancel</a>
                            <!-- <button type="submit" class="btn btn-dark" id="door">Cancel</button> -->
                        </form>

                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

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

</html>';
}
else{
    session_destroy();
    echo '<br><br><br><br><br>';
    echo '<h1 style = "text-align: center; justify-content: center; ">Session Expired.</h1>';
    echo '<h1 style = "text-align: center; justify-content: center; ">Login again to continue.</h1>';
}
?>

