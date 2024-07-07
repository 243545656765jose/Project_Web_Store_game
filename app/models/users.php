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


function getUsername($user_id) {
    $conn = require_once $_SERVER['DOCUMENT_ROOT'].'/app/utils/database.php';
    $stmt = $conn->prepare('SELECT username FROM users WHERE id = ?');
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->bind_result($username);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    
    return $username;
}
