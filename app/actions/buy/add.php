<?php
session_start();
$id = $_SESSION['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = require_once $_SERVER['DOCUMENT_ROOT'] . '/app/utils/database.php';
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = $conn->real_escape_string($_POST['precio']);
    $category = $conn->real_escape_string($_POST['category']);
    $stmt = $conn->prepare("INSERT INTO products (title, description, price, category, user_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('ssdsi', $title, $description, $price, $category, $id);
    if ($stmt->execute()) {
        header('Location: /app/pages/menu.php?categoria=' . urlencode($category));
        exit;
    } else {
        exit;
    }
}
?>