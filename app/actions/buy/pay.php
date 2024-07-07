<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/models/products.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id = $_SESSION['id'];
    $product_ids = $_POST['product_id'];
    $quantities = $_POST['quantity'];
    $prices = $_POST['price'];
    $totals = $_POST['total'];
    $result = get_last_order_number();
    if ($result) {
        $order_number = $result['order_number'];
        $order_n = $order_number + 1;
    } else {
        $orderid = 1;
    }

    for ($i = 0; $i < count($product_ids); $i++) {
        $product_id = $product_ids[$i];
        $quantity = $quantities[$i];
        $price = $prices[$i];
        $total = $totals[$i];
        $success = insert_order_product($user_id, $product_id, $quantity, $price, $order_n);
        if (!$success) {
            echo 'Error al insertar el producto en la orden.';
            exit;
        }
    }
    header('Location: /app/pages/menu.php');
    exit;
} else {
    echo 'Método de solicitud no válido.';
    exit;
}

