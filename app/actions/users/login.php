<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/models/users.php';
if ($_POST['username'] && $_POST['password']) {
    $result = authenticate_user($_POST['username'], $_POST['password']);
    if ($result) {
        session_start();
        $_SESSION['username'] = $result;
        $_SESSION['id'] = $result;
        header('Location: /app/pages/menu.php');
    } else {
        header('Location: /app/pages/index.php');
    }
} else {
    header('Location: /app/pages/index.php');
}
