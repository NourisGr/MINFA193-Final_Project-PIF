<?php
    // Connect to db if not already connected.
    $connected = false;
    function connectToDb() {

        $hostName = "localhost";
        $userName = "root";
        $password = "";
        $dbName = "minfa193_datacorp";
        $conn = new mysqli($hostName, $userName, $password, $dbName);
        
        if (!$conn) {
            die();
        }

        $connected = true;
        return $conn;
    }
?>