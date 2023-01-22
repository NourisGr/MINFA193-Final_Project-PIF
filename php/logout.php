<?php
    if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // If user session exist, delete session and send user to register page.
    if (isset($_SESSION['email'])) {
        unset($_SESSION['email']);
        header('Location: ../register.php');
    }
?>