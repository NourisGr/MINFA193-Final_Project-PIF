<?php
    if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // If user is already logged in, send back to index
    if (isset($_SESSION['email'])) {
        header('Location: ../index.php');
    }

    // If email wasn't posted, send user back to register.
    if (!isset($_POST['email'])) {
        header('Location: ../register.php');
    }

    INCLUDE_ONCE './db_connector.php';
    $conn = connectToDb();

    // If Method is POST
    if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
        // Get Form Data
        $password = $_POST['password'];
        $email = $_POST['email'];
        $rfid = $_POST['rfid'];
        $first_name = $_POST['first_name'];
        $surname = $_POST['last_name'];
        
        // Prepare and execute sql query to check if user already exists, if user
        // already exists, send him back to register again
        $sql = "SELECT DISTINCT* from employees WHERE email = '%s'";
        $sql = sprintf($sql, $email);
        if ($conn->query($sql)->num_rows>0) {
            header('Location: ../register.php');
        }

        // Prepare and execute sql query to insert user to employees table
        // If the query was successful, user gets redirected to index
        // else, user gets redirected to register page.
        $sql = "INSERT INTO employees (`first_name`, `last_name`,
        `email`, `password`, `group`, `RFIDBadge`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')";
        $sql = sprintf($sql, $first_name, $surname, $email, password_hash($password, PASSWORD_DEFAULT), 4, intval($rfid));
        if ($conn->query($sql)) {
            $_SESSION['email'] = $email;
            header('Location: ../index.php');
        } else {
            header('Location: ../register.php');
        }
    }
?>