<?php
    function handleLoginRequest() {
        // Initialize session if it's not already initialized.
        if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Setup connection to database for queries.
        INCLUDE_ONCE './db_connector.php';
        $conn = connectToDb();

        // If Request Method is POST
        if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
            // Retrieve variables from form post using 'name' input attribute
            // We can directly derive their values because a check was made previously.
            
            $firstname = $_POST['firstname'];

            //update of the password updated on 04/02/2023
            $password = $_POST['password'];

            $lastname = $_POST['surname'];
            $email = $_POST['email'];
            $rfid = $_POST['rfid'];

            if (!empty($_POST['email'])) {
                $sql = "SELECT DISTINCT * from employees WHERE email = '%s'";
                $sql = sprintf($sql, $email);

                if ($conn->query($sql)) {
                    return;
                }

                $sql = "UPDATE employees SET email = '%s' WHERE email = '%s'";
                $sql = sprintf($sql, $email, $_SESSION['email']);

                if ($conn->query($sql)) {
                    $_SESSION['email'] = $email;
                }
            } 
            
            if (!empty($_POST['firstname'])) {
                $sql = "UPDATE employees SET first_name = '%s' WHERE email = '%s'";
                $sql = sprintf($sql, $firstname, $_SESSION['email']);
                $conn->query($sql);
            } 
             
            //update of the password added on 04/02/2023 

            if (!empty($_POST['password'])) {
                $sql = "UPDATE employees SET password = '%s' WHERE email = '%s'";
                $sql = sprintf($sql, password_hash($password, PASSWORD_DEFAULT), $_SESSION['email']);
                $conn->query($sql);
            } 

            if (!empty($_POST['surname'])) {
                $sql = "UPDATE employees SET last_name = '%s' WHERE email = '%s'";
                $sql = sprintf($sql, $lastname, $_SESSION['email']);
                $conn->query($sql);
            } 

            if (!empty($_POST['rfid'])) {
                $sql = "UPDATE employees SET RFIDBadge = '%s' WHERE email = '%s'";
                $sql = sprintf($sql, $rfid, $_SESSION['email']);
                $conn->query($sql);
            }

            header('Location: ../dashboard.php');
        }
    }

    handleLoginRequest();
?>