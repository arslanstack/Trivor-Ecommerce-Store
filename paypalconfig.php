<?php
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
session_start();
require './autoload.php';

// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`.
$enableSandbox = true;

// PayPal settings. Change these to your account details and the relevant URLs
// for your site.
$paypalConfig = [
    'client_id' => 'ATuCq2IXjKZ4ShYL7tfg_OJwRHSssjoe739621-qYF7fRsa4w7awWvFcx05uCagFOo1Dsmyo6fo7L4rd',
    'client_secret' => 'EGBHmRk85WXzxecptjp3Q5zS849pgbsFlamY1S0w2rQovY9djGjiY_RlKWJUFIaHT39BQ8W1mg-UMtQ2',
    'return_url' => 'http://localhost/trivor/response.php',
    'cancel_url' => 'http://localhost/trivor/payment-cancelled.php'
];



$apiContext = getApiContext($paypalConfig['client_id'], $paypalConfig['client_secret'], $enableSandbox);

/**
 * Set up a connection to the API
 *
 * @param string $clientId
 * @param string $clientSecret
 * @param bool   $enableSandbox Sandbox mode toggle, true for test payments
 * @return \PayPal\Rest\ApiContext
 */
function getApiContext($clientId, $clientSecret, $enableSandbox = false)
{
    $apiContext = new ApiContext(
        new OAuthTokenCredential($clientId, $clientSecret)
    );

    $apiContext->setConfig([
        'mode' => $enableSandbox ? 'sandbox' : 'live'
    ]);

    return $apiContext;
}
