<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

$apiContext = new ApiContext(
    new OAuthTokenCredential(
        'AYMURgf3tXXce11QYI8RCsEYx6-uSXDu3PVUm7hKw-zFogvhVmf6s-FHUd5MY98m7vtolOUrjFIAveuN', // ClientID
        'EDfri_j41JiWwopUEs9dkAjSvaQ-i9YRnd4xn5gVjpTlyaP0FAkPpmEtehS6BO_WqGOu548sEisTn6JH'  // ClientSecret
    )
);

$apiContext->setConfig(
    array(
        'mode' => 'sandbox',
        'log.LogEnabled' => true,
        'log.FileName' => '../PayPal.log',
        'log.LogLevel' => 'DEBUG', // Cambia esto a 'INFO' para producción
        'cache.enabled' => true,
    )
);
