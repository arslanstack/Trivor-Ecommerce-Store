<?php
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
session_start();
require 'paypalconfig.php';

if (empty($_GET['paymentId']) || empty($_GET['PayerID'])) {
    throw new Exception('The response is missing the paymentId and PayerID');
}

$paymentId = $_GET['paymentId'];
$payment = Payment::get($paymentId, $apiContext);

$execution = new PaymentExecution();
$execution->setPayerId($_GET['PayerID']);

try {
    // Take the payment
    $payment->execute($execution, $apiContext);

    try {
        
            $_SESSION['paypaltransactionid'] = $payment->getId();
            $_SESSION['paypalamount'] = $payment->transactions[0]->amount->total;
            header("location:http://localhost/trivor/success.php");


    } catch (Exception $e) {
        echo "Error 1";

    }

} catch (Exception $e) {
    echo "Error 2";

}

?>