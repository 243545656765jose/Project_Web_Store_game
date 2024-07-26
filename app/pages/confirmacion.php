<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/paypal_config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/products.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/utils/database.php';
session_start();

if (isset($_GET['success']) && $_GET['success'] == 'true') {
    if (isset($_GET['paymentId']) && isset($_GET['PayerID'])) {
        $paymentId = $_GET['paymentId'];
        $payerId = $_GET['PayerID'];
        $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);
        $execution = new \PayPal\Api\PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $apiContext);
            try {
                $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);
                $user_id = $_SESSION['id']; 
                
                $last_order_number = get_last_order_number();
                $new_order_number = $last_order_number ? $last_order_number + 1 : 1;
                for ($i = 0; $i < count($_SESSION['products']); $i++) {
                    insert_order_product($user_id, $_SESSION['products'][$i], $_SESSION['quantities'][$i], $_SESSION['prices'][$i], $new_order_number);
                }

                echo '<div class="alert alert-success text-center" role="alert">
                        ¡Pago realizado con éxito! ID de transacción: ' . htmlspecialchars($payment->getId()) . '
                      </div>';
            } catch (Exception $ex) {
                echo '<div class="alert alert-danger text-center" role="alert">
                        Error al obtener el pago: ' . htmlspecialchars($ex->getMessage()) . '
                      </div>';
            }
        } catch (Exception $ex) {
            echo '<div class="alert alert-danger text-center" role="alert">
                    Error al ejecutar el pago: ' . htmlspecialchars($ex->getMessage()) . '
                  </div>';
        }
    } else {
        echo '<div class="alert alert-warning text-center" role="alert">
                Pago cancelado.
              </div>';
    }
} else {
    echo '<div class="alert alert-warning text-center" role="alert">
            Pago cancelado.
          </div>';
}
?>
<div class="text-center">
    <a href="/app/pages/menu.php" class="btn btn-primary">Volver al menú</a>
</div>