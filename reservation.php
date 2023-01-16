<?php

    if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['email'])) {
        header('location: ./login.php');
    }

    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);

    if (!isset($queries['id']) || !isset($queries['day'])) {
        header('location: ./index.php');
    }

    $reservation_date = new DateTime(date('Y-m-d', strtotime(date('Y-m-d') . ' +' . $queries['day'] . 'days')));

    $sql = "SELECT * from info_reservation WHERE res_room = '" . $queries['id'] . "' and res_date = '" . '2022-12-16' . "'";
    INCLUDE_ONCE './php/db_connector.php';
    $db = connectToDb();


    $reserved_dates = array();
    if ($result = $db->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sql = "SELECT * FROM list_of_reservations WHERE res_id = '" . $row['res_id'] . "'";
            if ($result2 = $db->query($sql)) {
                $times = array();
                while ($row = mysqli_fetch_assoc($result2)) {
                    $data = $row['res_time_id'];
                    array_push($times, $data);
                }

                foreach ($times as $t) {
                    $sql = "SELECT * FROM time_of_reservation WHERE id='" . $t . "'";
                    if ($result3 = $db->query($sql)) {
                        array_push($reserved_dates, mysqli_fetch_assoc($result3)['start_time']);
                    }
                }
            }
        }
    }

?>

<body>
    <div class="reservation-container">
        <h1><?php echo $reservation_date->format("l Y-m-d"); ?></h1>
        <div class="reservation-header">
            <span class="room-id"> Room: <?php echo $queries['id']; ?> </span>
            <span class="room-number"> Room Number: B023 </span>
            <span class="room-capacity">20</span>
            <span class="room-description">Test</span>
        </div>
    </div>
</body>