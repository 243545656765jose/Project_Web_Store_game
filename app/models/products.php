<?php
function load_products($user_id)
{
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

