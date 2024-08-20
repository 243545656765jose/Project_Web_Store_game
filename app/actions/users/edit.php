<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/public/validation/global.php';
$conn = require $_SERVER['DOCUMENT_ROOT'] . '/app/utils/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $usernameError = validate_username($username);
    $emailError = validate_email($email);
    $passwordError = validate_password($password);

    $errors = array_filter([
        'username' => $usernameError,
        'email' => $emailError,
        'password' => $passwordError
    ]);

    if (!empty($errors)) {
        $errorsJson = json_encode(array_values($errors));
        header('Location: /app/pages/registerUser.php?errors=' . urlencode($errorsJson));
        exit;
    }


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $username = $conn->real_escape_string($username);
    $email = $conn->real_escape_string($email);
    $hashedPassword = $conn->real_escape_string($hashedPassword);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
    if ($conn->query($sql) === true) {
        header('Location: ../../index.php');
        exit;
    } else {
        header('Location: /app/pages/registerUser.php');
        echo "Error: " . $conn->error;
        exit;
    }
}