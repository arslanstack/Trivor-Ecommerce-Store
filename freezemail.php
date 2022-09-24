<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function mailed($email, $username, $name, $token)
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
        $mail->Subject = 'Account Frozen ' . $name . ' - Reactivate your Account';
        $mail->Body = '<!DOCTYPE html>
    <html>
    <head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
    <body class="respond" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <!-- pre-header -->
        <table style="display:none!important;">
            <tr>
                <td>
                    <div
                        style="overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;">
                        
                    </div>
                </td>
            </tr>
        </table>
        <!-- pre-header end -->
        <!-- header -->
        <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">
    
            <tr>
                <td align="center">
                    <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
    
                        <tr>
                            <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                        </tr>
    
                        <tr>
                            <td align="center">
    
                                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0"
                                    class="container590">
    
                                    <tr>
                                        <td align="center" height="70" style="height:70px;">
                                            <h2 class="display-2" style="">Trivor Cara</h2>
                                        </td>
                                    </tr>
    
    
                                </table>
                            </td>
                        </tr>
    
                        <tr>
                            <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                        </tr>
    
                    </table>
                </td>
            </tr>
        </table>
        <!-- end header -->
    
        <!-- big image section -->
    
        <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">
    
            <tr>
                <td align="center">
                    <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
    
                        <tr>
                            <td align="center"
                                style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;"
                                class="main-header">
                                <!-- section text ======-->
    
                                <div style="line-height: 35px">
    
                                    Your account has been <span style="color: #5caad2;">Frozen</span>
    
                                </div>
                            </td>
                        </tr>
    
                        <tr>
                            <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                        </tr>
    
                        <tr>
                            <td align="center">
                                <table border="0" width="40" align="center" cellpadding="0" cellspacing="0"
                                    bgcolor="eeeeee">
                                    <tr>
                                        <td height="2" style="font-size: 2px; line-height: 2px;">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
    
                        <tr>
                            <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                        </tr>
    
                        <tr>
                            <td align="left">
                                <table border="0" width="590" align="center" cellpadding="0" cellspacing="0"
                                    class="container590">
                                    <tr>
                                        <td align="left"
                                            style="color: #888888; font-size: 16px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;">
                                            <!-- section text ======-->
    
                                            <p style="line-height: 24px; margin-bottom:15px;">
    
                                                ' . $name . ',
    
                                            </p>
                                            <p style="line-height: 24px;margin-bottom:15px;">
                                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia similique
                                                laudantium ea quidem ipsam praesentium sequi, aliquid rerum natus blanditiis
                                                quam facere officiis, recusandae vero reiciendis iure at aut fugit!
                                            </p>
                                            <p style="line-height: 24px; margin-bottom:20px;">
                                               We noticed some suspicious activity on your account.<br> <br>
                                                Please open the link  below to regain access to your account. 
                                            </p>
                                            <table border="0" align="center" width="180" cellpadding="0" cellspacing="0"
                                                bgcolor="5caad2" style="margin-bottom:20px;">
    
                                                <tr>
                                                    <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                                                </tr>
    
                                                <tr>
                                                    <td align="center"
                                                        style="color: #ffffff; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 22px; letter-spacing: 2px;">
                                                        <!-- main section button -->
    
                                                        <div style="line-height: 22px;">
                                                            <a href="http://localhost/trivor/restore.php?token=' . $token . '" style="color: #ffffff; text-decoration: none;">RESET NOW</a>
                                                        </div>
                                                    </td>
                                                </tr>
    
                                                <tr>
                                                    <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                                                </tr>
    
                                            </table>
                                            <p style="line-height: 24px">
                                                Love,</br>
                                                Rakaposhi Team
                                            </p>
    
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
    
    
    
    
    
                    </table>
    
                </td>
            </tr>
    
            <tr>
                <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
            </tr>
    
        </table>
    
    </body>
    </html>
    ';
        $mail->AltBody = 'Dear' . $username . ', your Rakaposhi account is all set. <br>
    You need to click on activation link below in order to use it. <br> 
    Activation link is valid for few minutes only <br>
    http://localhost/trivor/restore.php?token=' . $token . '';

        $mail->send();
        // echo 'Message has been sent';
        $_SESSION['loginerror'] = "Your account has been frozen. Kindly check your email";
        header("Location: loginagain.php");
    }
    catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

    }

}
?>