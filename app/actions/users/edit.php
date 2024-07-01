<?php
session_start();
$user_id = $_SESSION['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conn = require $_SERVER['DOCUMENT_ROOT'].'/app/utils/database.php';
    $query = 'UPDATE users SET username=?, email=?, password=? WHERE id=?'; 
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssi', $username, $email, $password, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header('Location: /app/pages/userPerfil.php');
        exit;
    } 
    $stmt->close();
    $conn->close();
} 