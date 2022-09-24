<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function mailed($email, $username, $name, $orderno, $totalamount)
{
    require 'vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0; //Enable verbose debug output
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = 'backendt4@gmail.com'; //SMTP username
        $mail->Password = 'ixgnsensiquuzojj'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        //Recipients
        $mail->setFrom('backendt4@gmail.com', 'Trivor Cara');
        $mail->addAddress($email, $username); //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo('backendt4@gmail.com', 'Trivor Cara');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Welcome to Trivor Cara - ' . $name . ' - Activate your Account';
        $mail->Body = '<!DOCTYPE html>
        <html lang="en">
        
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
                integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
            <title>Document</title>
        </head>
        
        <body>
            <div class="container mx-auto">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="container mb-5 mt-3">
                                    <div class="row d-flex align-items-baseline">
                                        <div class="col-xl-9">
                                            <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID: #123-123</strong>
                                            </p>
                                        </div>
                                        <div class="col-xl-3 float-end">
                                            <button onclick="window.print();" class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                                                    class="fas fa-print text-primary" ></i> Print</button>
                                        </div>
                                        <hr>
                                    </div>
        
                                    <div class="container">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
                                                <h1 class="display-4 pt-0">Trivor Cara</h1>
                                            </div>
        
                                        </div>
        
        
                                        <div class="row">
                                            <div class="col-xl-8">
                                                <ul class="list-unstyled">
                                                    <li class="text-muted">To: <span style="color:#5d9fc5 ;">'.$name.'</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-xl-4">
                                                <p class="text-muted">Invoice</p>
                                                <ul class="list-unstyled">
                                                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i>
                                                        <span class="fw-bold">ID:</span>#123-456</li>
                                                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i>
                                                        <span class="fw-bold">Creation Date: </span><?php echo time(); ?></li>
                                                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i>
                                                        <span class="me-1 fw-bold">Status:</span><span
                                                            class="badge bg-warning text-black fw-bold">
                                                            Paid</span></li>
                                                </ul>
                                            </div>
                                        </div>
        
                                        <div class="row my-2 mx-1 justify-content-center">
                                            <table class="table table-striped table-borderless">
                                                <thead style="background-color:#84B0CA ;" class="text-white">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">OrderID</th>
                                                        <th scope="col">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>'.$orderno.'</td>
                                                        <td>'.$totalamount.'</td>
                                                    </tr>
                                                    
                                                </tbody>
        
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-8">
        
                                            </div>
                                            <div class="col-xl-3">
                                                
                                                <p class="text-black float-start"><span class="text-black me-3"> Total
                                                        Amount  </span><span style="font-size: 25px;"><$ '.$totalamount.'</span></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-xl-10">
                                                <p>Thank you for your purchase</p>
                                            </div>
                                        </div>
        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
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
        $mail->AltBody = 'Order Placed Successfuly';

        $mail->send();
        $_SESSION['msg'] = "Acivation link sent on your email.";
        header("Location: middle.php");
        // echo 'Message has been sent';
        // $_SESSION['loginerror'] = "Your account has been frozen. Kindly check your email";
        // header("Location: loginagain.php");
    }
    catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

    }

}
