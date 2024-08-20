<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
define('SESSION_TIMEOUT', 1800);

if (isset($_SESSION['LAST_ACTIVITY'])) {
    $inactive = time() - $_SESSION['LAST_ACTIVITY'];
    if ($inactive > SESSION_TIMEOUT) {
        session_unset();    
        session_destroy();  
        header('Location: ../../index.php?error=session_expired'); 
        exit;
    }
}
$_SESSION['LAST_ACTIVITY'] = time();

