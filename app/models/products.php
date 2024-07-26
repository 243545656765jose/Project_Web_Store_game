<?php

function load_products($user_id) {
    $conn = require $_SERVER['DOCUMENT_ROOT'].'/app/utils/database.php';
    $query = 'SELECT * FROM products WHERE user_id=?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;
    } else {
        return null;
    }
}

function delete($id_product) {
    $conn = require $_SERVER['DOCUMENT_ROOT'].'/app/utils/database.php';
    $stmt = $conn->prepare('DELETE FROM products WHERE id=?');
    $stmt->bind_param('i', $id_product);
    $result = $stmt->execute();
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function insert_order_product($user_id, $product_id, $quantity, $price, $order_number) {
    $conn = require $_SERVER['DOCUMENT_ROOT'].'/app/utils/database.php';
    $stmt = $conn->prepare('INSERT INTO order_products (user_id, product_id, amount, price, order_number, order_date) VALUES (?, ?, ?, ?, ?, NOW())');
    $stmt->bind_param('iiiid', $user_id, $product_id, $quantity, $price, $order_number);
    $result = $stmt->execute();
    return $result;
}


function get_last_order_number() {
    $conn = require $_SERVER['DOCUMENT_ROOT'].'/app/utils/database.php';
    $query = "SELECT MAX(order_number) as order_number FROM order_products";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $last_order_number = $row['order_number'];
        return $last_order_number;
    } else {
        return false;
    }
}

function get_order_history($user_id) {
    $conn = require $_SERVER['DOCUMENT_ROOT'].'/app/utils/database.php';
    $query = 'SELECT op.order_number, MAX(op.order_date) as order_date, SUM(op.price * op.amount) as total 
              FROM order_products op 
              WHERE op.user_id = ? 
              GROUP BY op.order_number';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $orders = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
        return $orders;
    } else {
        return null;
    }
}