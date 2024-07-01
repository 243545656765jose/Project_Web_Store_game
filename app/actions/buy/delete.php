<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/app/models/products.php';

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $success = delete($product_id);
    if ($success) {
        header('Location: /app/pages/menu.php');
        exit;
    } else {
        echo 'Error al eliminar el producto.';
    }
} else {
    echo 'No se proporcionó el ID del producto.';
}
