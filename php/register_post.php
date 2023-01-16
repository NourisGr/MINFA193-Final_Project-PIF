<?php
    if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_POST['email']) || isset($_SESSION['email'])) {
        header('Location: ../index.php');
    }

    INCLUDE_ONCE './db_connector.php';
    $conn = connectToDb();

    if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
        $password = $_POST['password'];
        $email = $_POST['email'];
        $rfid = $_POST['rfid'];
        $first_name = $_POST['first_name'];
        $surname = $_POST['last_name'];

        
        $sql = "SELECT * from employees WHERE email = '%s'";
        $sql = sprintf($sql, $email);
        if ($conn->query($sql)) {
            header('Location: ../register.php');
        }

        $sql = "INSERT INTO employees (`first_name`, `last_name`, `email`, `password`, `group`, `RFIDBadge`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')";
        // The intval() function returns the integer value of a variable.
        // Returns a string produced according to the formatting string format. 
        $sql = sprintf($sql, $first_name, $surname, $email, password_hash($password, PASSWORD_DEFAULT), 1, intval($rfid));
       
        if ($conn->query($sql)) {
            $_SESSION['email'] = $email;
            header('Location: ../index.php');
        } else {
            header('Location: ../register.php');
        }
    }
?>