<?php
session_start();
if (ini_get("session.use_cookies")) {
    $cookis = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $cookis["path"], $cookis["domain"],
        $cookis["secure"], $cookis["httponly"]
    );
}
session_destroy();
header("Location:  ../../index.php");
exit;

