<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/paypal_config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/products.php';
session_start();

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

if (isset($_GET['success']) && $_GET['success'] == 'true') {
    $paymentId = $_GET['paymentId'];
    $payerId = $_GET['PayerID'];

    $payment = Payment::get($paymentId, $apiContext);

    $execution = new PaymentExecution();
    $execution->setPayerId($payerId);

    try {
        $result = $payment->execute($execution, $apiContext);
        try {
            $payment = Payment::get($paymentId, $apiContext);
            echo "Pago realizado con éxito. ID de transacción: " . $payment->getId();
            header("Location: /app/pages/confirmacion.php?status=success&paymentId=" . $payment->getId());
        } catch (Exception $ex) {
            header("Location: /app/pages/confirmacion.php?status=error&message=" . urlencode($ex->getMessage()));
        }
    } catch (Exception $ex) {
        header("Location: /app/pages/confirmacion.php?status=error&message=" . urlencode($ex->getMessage()));
    }
} else {
    header("Location: /app/pages/confirmacion.php?status=error&message=Usuario canceló el pago.");
}
?>
