<?php
session_start();
require 'config.php';
$sql = "SELECT address FROM userdata WHERE username = '{$_SESSION['userid']}'";
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        if (empty($row['address'])) {
            if(isset($_POST['name'])){
                $address = $_POST['address'];
                $sql = "UPDATE userdata SET address = '{$address}' WHERE username = '{$_SESSION['userid']}'";
                if ($result = mysqli_query($conn, $sql)) {
                    header("Location: orderstagetwo.php");
                }
                else{

                }
            }
        } else {
            header("Location: orderstagetwo.php");
        }
    } else {
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
    <title>Rakaposhi</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="signup.css">
</head>

<body>

    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <!--Section: Contact v.2-->
                <section class="mb-4">

                    <!--Section heading-->
                    <h2 class="h1-responsive font-weight-bold text-center my-4">Delivery Address</h2>
                    <!--Section description-->
                    <p class="text-center w-responsive mx-auto mb-5">Please enter address you want to receive your packages.</p>

                    <div class="row">

                        <!--Grid column-->
                        <div class="col-md-12 mb-md-0 mb-5">
                            <form action="" method="POST">

                                <!--Grid row-->
                                <div class="row">

                                    <!--Grid column-->
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <label for="name" class="">Recepient Name</label>
                                            <input type="text" name="name" class="form-control">

                                        </div>
                                    </div>
                                    <!--Grid column-->

                                    <!--Grid column-->
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <label for="email" class="">Recepient Phone</label>
                                            <input type="text" name="phone" class="form-control">

                                        </div>
                                    </div>
                                    <!--Grid column-->

                                </div>
                                <!--Grid row-->
                                <br>
                                <!--Grid row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="md-form mb-0">
                                            <label for="subject" class="">Address</label>
                                            <textarea type="text" name="address" rows="4" class="form-control md-textarea"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <!--Grid row-->
                                <input style="float: right;" type="submit" class="btn btn-dark" value="Complete Order">
                                

                            </form>

                            


                    </div>

                </section>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <!--Section: Contact v.2-->
    <!-- JS Popper Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>