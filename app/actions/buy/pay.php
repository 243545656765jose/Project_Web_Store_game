<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/paypal_config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/products.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/utils/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_method = $_POST['payment_method'];

    if ($payment_method === 'paypal') {
        $items = [];
        $total = 0;

        for ($i = 0; $i < count($_POST['product_id']); $i++) {
            $item = new \PayPal\Api\Item();
            $item->setName($_POST['title'][$i])
                ->setCurrency('USD')
                ->setQuantity($_POST['quantity'][$i])
                ->setPrice($_POST['price'][$i]);
            $items[] = $item;
            $total += $_POST['total'][$i];
        }

        // Guardar los detalles del pedido en la sesión
        $_SESSION['products'] = $_POST['product_id'];
        $_SESSION['quantities'] = $_POST['quantity'];
        $_SESSION['prices'] = $_POST['price'];
        $_SESSION['titles'] = $_POST['title'];
        $_SESSION['totals'] = $_POST['total'];
        $_SESSION['order_total'] = $total;

        $itemList = new \PayPal\Api\ItemList();
        $itemList->setItems($items);

        $details = new \PayPal\Api\Details();
        $details->setSubtotal($total);

        $amount = new \PayPal\Api\Amount();
        $amount->setCurrency('USD')
            ->setTotal($total)
            ->setDetails($details);

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Pago en AcuRey Gaming')
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl("http://localhost:3000/app/pages/confirmacion.php?success=true")
            ->setCancelUrl("http://localhost:3000/app/pages/confirmacion.php?success=false");

        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($apiContext);
            $approvalUrl = $payment->getApprovalLink();
            header("Location: $approvalUrl");
            exit(); // Asegúrate de terminar el script después de la redirección
        } catch (Exception $ex) {
            header("Location: /app/pages/confirmacion.php?status=error&message=" . urlencode($ex->getMessage()));
            exit(); // Asegúrate de terminar el script después de la redirección
        }
    } else {
        header("Location: /app/pages/confirmacion.php?status=error&message=Método de pago no soportado.");
        exit(); // Asegúrate de terminar el script después de la redirección
    }
}
?>
