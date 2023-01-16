<?php
    echo "test";
    function handleLoginRequest() {
        // Initialize session if it's not already initialized.
        if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // If the user is already logged in, redirect them back to the main page and halt execution. 
        if (isset($_SESSION['email'])) {
            header('Location: ../index.php');
            return;
        }

        // If the user did not get to this file via the login form submittion (username or password were not set in the form),
        // then send them back to the login page and halt execution.

        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            header('Location: ../login.php');
            return;
        }

        // Setup connection to database for queries.
        INCLUDE_ONCE './db_connector.php';
        $conn = connectToDb();

        // If Request Method is POST
        if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
            // Retrieve variables from form post using 'name' input attribute
            // We can directly derive their values because a check was made previously.
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Setup SQL Query
            $sql = "SELECT DISTINCT * FROM employees WHERE email = '%s'";
            $sql = sprintf($sql, $email);
            echo $sql;
            // Execute SQL Query
            $result = $conn->query($sql);
            $pwd_equals = false;

            // If SQL Query was successful, then set $pwd_equals = true.
            if ($result) {
                $row = $result->fetch_assoc();
                // password_verify() is a php built-in function that allows us to check if parameter A ($password)
                // is equal to parameter B ($row['password']) after parameter B was hashed.
                if (password_verify($password, $row['password'])) {
                    // If they're equal, then set Session, Redirect user to main page, and halt the function.
                    $_SESSION['email'] = $email;
                    header('Location: ../index.php');
                    return;
                }
            }
            // Else, go back to login
            header('Location: ../login.php');
        }
    }

    handleLoginRequest();
?>