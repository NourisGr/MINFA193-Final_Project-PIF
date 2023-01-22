<?php
    if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // If purpose hasn't been posted, send user back to reservation.
    if (!isset($_POST['purpose'])) {
        header('Location: ../reservation.php');
    }

    INCLUDE_ONCE './db_connector.php';
    $conn = connectToDb();

    // Calculate times selected by user
    $times = [];
    $c = 0;
    for ($i = 0; $i < 9; $i++) {
        if (isset($_POST[$i + 8])) {
            if (strlen(strval($_POST[$i + 8])) > 0) {
                $times[$c] = ($i + 1);
                $c++;
            }
        }
    }

    // Split query parameters on array and get purpose
    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);
    $purpose = $_POST['purpose'];

    // Prepare and execute sql query to get already reserved dates
    $sql = "INSERT INTO info_reservation(`res_room`, `res_date`, `res_purpose`, `res_userEmail`) VALUES('%s','%s','%s','%s')";
    $sql = sprintf($sql, $queries['room_id'], 
    (new DateTime('now', new DateTimeZone('Europe/Paris')))->modify("+ {$queries['date']} day")->format("Y-m-d"), $purpose, $_SESSION['email']);
    $conn->query($sql);

    // Prepare and execute sql query to insert times into list_of_reservations
    $sql = "SELECT * FROM info_reservation ORDER BY res_id DESC LIMIT 1;";
    $res = $conn->query($sql);
    $res_id;
    if ($res) {
        $res_id = $res->fetch_assoc()['res_id'];
    }

    // For each time in $_POST times insert time into list_of_reservation with res_id equal to
    // the reservation that we just inserted.
    for ($i = 0; $i < count($times); $i++) {
        $sql = "INSERT INTO list_of_reservations (`res_id`, `res_time_id`) VALUES ('${res_id}', '${times[$i]}')";
        $conn->query($sql);
    }

    // Send user back to index
    header("Location: ../index.php");
?>