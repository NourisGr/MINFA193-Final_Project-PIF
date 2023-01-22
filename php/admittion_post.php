<?php
    if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['email'])) {
        header("Location: ../login.php");
    }

    // Setup connection to database for queries.
    INCLUDE_ONCE './db_connector.php';
    $db = connectToDb();

    // Create query to get all non-admitted employees
    $sql = "SELECT DISTINCT * FROM EMPLOYEES WHERE `group` = '4'";
    $result = $db->query($sql);
    $to_admit = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            array_push($to_admit, $row);
        }
    }
    // If Request Method is POST
    // The strtoupper() function converts a string to uppercase.
    if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
        $sql = "UPDATE employees SET `group` = '3' WHERE `email` = '%s';";
        $sql = sprintf($sql, $_POST["useremail"]);
        $db->query($sql);
    }
    header("Location: ../admittion.php");
    die();

?>