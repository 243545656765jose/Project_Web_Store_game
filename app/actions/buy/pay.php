<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/paypal_config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/products.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/utils/database.php';
session_start();

use PayPal\Api\WebProfile;
use PayPal\Api\FlowConfig;
use PayPal\Api\InputFields;
use PayPal\Api\Presentation;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payer;
use PayPal\Api\Payment;

if (!isset($_SESSION['experience_profile_id'])) {
    $flowConfig = new FlowConfig();
    $flowConfig->setLandingPageType("Login"); 

    $inputFields = new InputFields();
    $inputFields->setNoShipping(1); 
    $inputFields->setAddressOverride(0);

    $presentation = new Presentation();
    $presentation->setBrandName("AcuRey Gaming")
        ->setLocaleCode("US")
        ->setReturnUrlLabel("Return")
        ->setNoteToSellerLabel("Thanks!");

    $webProfile = new WebProfile();
    $webProfile->setName("AcuRey Gaming " . uniqid())
        ->setFlowConfig($flowConfig)
        ->setInputFields($inputFields)
        ->setPresentation($presentation);

    try {
        $createProfileResponse = $webProfile->create($apiContext);
        $experienceProfileId = $createProfileResponse->getId();
        $_SESSION['experience_profile_id'] = $experienceProfileId;
    } catch (Exception $ex) {
        die($ex);
    }
} else {
    $experienceProfileId = $_SESSION['experience_profile_id'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_method = $_POST['payment_method'];

    if ($payment_method === 'paypal') {
        $items = [];
        $total = 0;

        for ($i = 0; $i < count($_POST['product_id']); $i++) {
            $item = new Item();
            $item->setName($_POST['title'][$i])
                ->setCurrency('USD')
                ->setQuantity($_POST['quantity'][$i])
                ->setPrice($_POST['price'][$i]);
            $items[] = $item;
            $total += $_POST['total'][$i];
        }
        $_SESSION['products'] = $_POST['product_id'];
        $_SESSION['quantities'] = $_POST['quantity'];
        $_SESSION['prices'] = $_POST['price'];
        $_SESSION['titles'] = $_POST['title'];
        $_SESSION['totals'] = $_POST['total'];
        $_SESSION['order_total'] = $total;

        $itemList = new ItemList();
        $itemList->setItems($items);

        $details = new Details();
        $details->setSubtotal($total);

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($total)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Pago en AcuRey Gaming')
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("http://localhost:3000/app/pages/confirmacion.php?success=true")
            ->setCancelUrl("http://localhost:3000/app/pages/confirmacion.php?success=false");

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls)
            ->setExperienceProfileId($experienceProfileId);

        try {
            $payment->create($apiContext);
            $approvalUrl = $payment->getApprovalLink();
            header("Location: $approvalUrl");
            exit(); 
        } catch (Exception $ex) {
            header("Location: /app/pages/confirmacion.php?status=error&message=" . urlencode($ex->getMessage()));
            exit(); 
        }
    } else {
        header("Location: /app/pages/confirmacion.php?status=error&message=Método de pago no soportado.");
        exit(); 
    }
}
?>
