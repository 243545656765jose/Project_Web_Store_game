<?php
function authenticate_user($username, $password) {
    $conn = require $_SERVER['DOCUMENT_ROOT'].'/app/utils/database.php';
    $username = $conn->real_escape_string($username);
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if (!$result) {
        echo "Error en la consulta: " . $conn->error;
        return null;
    }

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            return $user;
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }

    return null;
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
