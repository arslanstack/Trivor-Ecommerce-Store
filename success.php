<?php
session_start();
require './config.php';
$sql = "UPDATE sales SET amount = '{$_SESSION['paypalamount']}', txnid = '{$_SESSION['paypaltransactionid']}', status = 'completed' WHERE orderno = '{$_SESSION['orderno']}'";
if (mysqli_query($conn, $sql)) {
    echo "Payment Successful";
    echo $_SESSION['paypalamount'] . 'PAYPAL AMOUNT <br>';
    echo $_SESSION['paypaltransactionid'] . 'PAYPAL TTRANSACTION ID <br>';
    echo $_SESSION['orderno'] . 'PAYPAL ORDERNO <br>';
    $sql = "DELETE FROM cartproduct WHERE username = '{$_SESSION['userid']}'";
    if ($result = mysqli_query($conn, $sql)) {
        header("location:http://localhost/trivor/orders.php");
        
    }
    
}
?>
