<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    $current_page = basename($_SERVER['PHP_SELF']);
    if ($current_page !== 'index.php') {
        header("Location: /app/pages/index.php");
        exit();
    }
}
?>
