<?php
function authenticate_user($username, $password) {
    $conn = require $_SERVER['DOCUMENT_ROOT'].'/app/utils/database.php';
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        return $user;
    } else {
        return null;
    }
}