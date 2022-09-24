<?php

// error_reporting(0);
session_start();

if ($_SESSION['sessionadmin'] == true && (time() - $_SESSION['logintimeadmin'] < 1800)) {
    $_SESSION['logintimemod'] = time();
    echo '<!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Ajax Jquerry CDN -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <!-- Random -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="style1.css">
        <!-- Datatable CSS for exporting -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
        <title>Admin Panel</title>
        <style>
            td,
            th {
                text-align: center;
            }
        </style>
    </head>
    
    <body>
        <br>
        <h1 class="display-4 text-center">Confidential</h1>
        <br><br>
        <div class="container-fluid mx-auto">
            <div class="row">
                <div class="col" id="contains">
                    
                    <div class="">
                        <h2 class="" style="float: left">Order # '.$_SESSION['delee'].'</h2> 
                        <h2 class="text-center"> Total Order Amount: $'.$_SESSION['amount'].'</h2><br> <br><br>
                        <a href="saleview.php" class="btn btn-dark" style="float: left;">Go Back</a>
                        <a href="addproduct.php" class="btn btn-success" style="float: right"><i class="fa fa-plus"></i> Add New
                            Product</a>
                    </div>
                    <br><br>
                    <table id="prod_table" class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>PRODUCTID</th>
                                <th>PRICE ($)</th>
                                <th>QUANTITY</th>
                                <th>AMOUNT ($)</th>
                            </tr>
                        </thead>
                        <tbody>';
                            // Include config file
                            require_once "./../config.php";
    
                            // Attempt select query execution
                            $sql = "SELECT * FROM orders WHERE orderid = '{$_SESSION['delee']}'";
                            if ($result = mysqli_query($conn, $sql)) {
                                if (mysqli_num_rows($result) > 0) {
                                    $count = 0;
                                    while ($row = mysqli_fetch_array($result)) {
                                        $count++;
                                        //
                                        echo '<tr>
                                        <td>' . $count . '</td>
                                        <td>' . $row['prodid'] . '</td>
                                        <td>' . $row['price'] . '</td>
                                        <td>' . $row['quantity'] . '</td>
                                        <td>' . $row['amount'] . '</td>
    
                                        
                                        
                                        </tr>';
                                    }
                                    // Free result set
                                    mysqli_free_result($result);
                                }
                                else{
                                    echo "Error 2    : " . $sql . "<br>" . mysqli_error($conn);
                                }
                            } else {
                                echo "Error 1    : " . $sql . "<br>" . mysqli_error($conn);
                            }
    
                            // Close connection
                            mysqli_close($conn);

                        echo ' </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container">
    
        </div>
        <!-- Exporting Functionalities -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#prod_table").DataTable({
                    dom: "Bfrtip",
                    buttons: [
                        "copy", "csv", "excel", "pdf", "print"
                    ]
                });
            });
        </script>
    
    </body>
    
    </html>';
} else {
    session_destroy();
    echo '<br><br><br><br><br>';
    echo '<h1 style = "text-align: center; justify-content: center; ">Session Expired.</h1>';
    echo '<h1 style = "text-align: center; justify-content: center; ">Login again to continue.</h1>';
}
?>
