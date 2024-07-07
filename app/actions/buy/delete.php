<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/utils/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/public/js/car.js';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['id'];
    $product_id = $_POST['product_id'];
    $conn = require $_SERVER['DOCUMENT_ROOT'] . '/app/utils/database.php';

    $stmt = $conn->prepare('DELETE FROM products WHERE user_id = ? AND id = ?');
    $stmt->bind_param('ii', $user_id, $product_id);

    if ($stmt->execute()) {
        // Vacia el carrito en la base de datos
        $stmt = $conn->prepare('DELETE FROM order_products WHERE user_id = ?');
        $stmt->bind_param('i', $user_id);
        $stmt->execute();

        // Redirige de nuevo al carrito después de eliminar el producto
        header("Location: /app/pages/menu.php");
        exit();
    } else {
        echo 'Error al eliminar el producto.';
    }
}
?>
