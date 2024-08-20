<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/models/users.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = authenticate_user($username, $password);

    if ($result) {
        session_start();
        $_SESSION['id'] = $result['id']; 
        $_SESSION['username'] = $result['username']; 
        $_SESSION['email'] = $result['email']; 
        $_SESSION['rol'] = $result['rol'];

        if ($result['rol'] === 'Administrador') {
            header('Location: /app/pages/administration.php');
        } elseif ($result['rol'] === 'Usuario') {
            header('Location: /app/pages/menu.php');
        } else {
            header('Location: /app/pages/index.php?error=3');
        }
        exit;
    } else {
        header('Location: /app/pages/index.php?error=1'); 
        exit;
    }
} else {
    header('Location: /app/pages/index.php?error=2'); 
    exit;
}
