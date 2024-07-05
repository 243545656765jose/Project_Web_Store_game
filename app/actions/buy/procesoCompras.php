<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['product_id']) && is_array($_POST['product_id'])) {
        $product_ids = $_POST['product_id'];
        $titles = $_POST['title'];
        $quantities = $_POST['quantity'];
        $prices = $_POST['price'];
        $totals = $_POST['total'];
        
        for ($i = 0; $i < count($product_ids); $i++) {
            echo "Producto ID: " . htmlspecialchars($product_ids[$i]) . "<br>";
            echo "Título: " . htmlspecialchars($titles[$i]) . "<br>";
            echo "Cantidad: " . htmlspecialchars($quantities[$i]) . "<br>";
            echo "Precio: $" . htmlspecialchars($prices[$i]) . "<br>";
            echo "Total: $" . htmlspecialchars($totals[$i]) . "<br><br>";
        }
    } else {
        echo "No se enviaron productos en el carrito.";
    }
} else {
    echo "Método de solicitud no permitido.";
}