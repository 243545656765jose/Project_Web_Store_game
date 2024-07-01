<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = require_once $_SERVER['DOCUMENT_ROOT'] . '/app/utils/database.php';
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "INSERT INTO users (username,email,password) values ('$username','$email','$password')";

    if ($conn->query($sql)==true) {
        header('location:/app/pages/index.php');
        exit;
    }else{
        header('location:/app/pages/registerUser.php');
        echo"errrp";
        exit;
    }
}