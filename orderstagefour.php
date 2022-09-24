<?php
    session_start();
    $orderno = $_SESSION['orderno'];


    use PayPal\Api\Amount;
    use PayPal\Api\Payer;
    use PayPal\Api\Payment;
    use PayPal\Api\RedirectUrls;
    use PayPal\Api\Transaction;
    use PayPal\Api\ItemList;
    
    require './paypalconfig.php';
    
    if (empty($orderno)) {
        throw new Exception('This script should not be called directly, expected post data');
    }
    
    $payer = new Payer();
    $payer->setPaymentMethod('paypal');
    
    // Set some example data for the payment.
    $currency = 'USD';
    $amountPayable = $_SESSION['totalamount'];
    $item_code = $orderno;
        
    $amount = new Amount();
    $amount->setCurrency('USD')
        ->setTotal($amountPayable);
    

        
    $transaction = new Transaction();
    $transaction->setAmount($amount);
    
    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl($paypalConfig['return_url'])
        ->setCancelUrl($paypalConfig['cancel_url']);
    
    $payment = new Payment();
    $payment->setIntent('sale')
        ->setPayer($payer)
        ->setTransactions([$transaction])
        ->setRedirectUrls($redirectUrls);
    
    try {
        $payment->create($apiContext);
    } catch (Exception $e) {
        throw new Exception('Unable to create link for payment');
    }
    
    header('location:' . $payment->getApprovalLink());
    exit(1);
?>