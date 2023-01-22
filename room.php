<?php
    INCLUDE_ONCE './header.php';

    // If session isn't set, send user back to login
    if (!isset($_SESSION['email'])) {
        header("Location: ./login.php");    
    }

    // parse query parameters
    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);

    INCLUDE_ONCE './php/db_connector.php';
    $db = connectToDb();

    // Prepare and execute statement and filtering to get information (room_number, room_capacity, room_description) for current room
    $sql = "SELECT DISTINCT * FROM conference_rooms";
    $result = $db->query($sql);
    $incr = 0;
    $ro_num = "None";
    $ro_cap = 0;
    $ro_desc = "None";
    if ($result) {
        $incr = $result->num_rows;
        while ($row = $result->fetch_assoc()) {
            if ($row['room_id'] == $queries['id']) {
                $ro_num = $row['room_number'];
                $ro_cap = $row['room_capacity'];
                $ro_desc = $row['room_description'];
            }
        }
    }

    // if id does not correspond to a valid conference room, send the user back to the home page.
    if ($queries['id'] > $incr) {
        header("Location: ./");   
    }

    // returns: <bool> - Check if date given is weekend
    function isWeekend($date) {
        return (date('N', strtotime($date)) >= 6);
    }

    // returns: <bool> = Check if a day's hour has elapsed based on given hour (function parameter)
    function hasElapsed($hour) {
        return $hour >= date('H');
    }

    // Prepare statement to get available times for each date
    $sql = "SELECT DISTINCT * FROM info_reservation INNER JOIN list_of_reservations 
    ON info_reservation.res_id = list_of_reservations.res_id 
    WHERE info_reservation.res_room = '%s' AND info_reservation.res_date >= '%s'";
    $sql = sprintf($sql, $queries['id'], date('Y-m-d'));

    // Get data from previous query
    $data = [];
    $result = $db->query($sql);
    if ($result) {
        while($row = $result->fetch_assoc()) {
            array_push($data, $row);
        }
    }
?>

<head>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/room.css">
</head>

<body>
    <div class="room-model-container">
        <span class="room-title">Conference Room #<?php echo $queries['id']; ?></span>
        <div class="room-data-container">
            <span class="annotation">Room number:</span> <span class="room-number"><?php echo $ro_num; ?></span>
            <span class="annotation">Room capacity:</span> <span class="room-capacity"><?php echo $ro_cap; ?></span>
            <span class="annotation">Room Description:</span> <span class="room-description"><?php echo $ro_desc; ?>s</span>
        </div>
        <div class="room-days-container">
            <?php
                $begin = new DateTime(date('Y-m-d'));
                $end = new DateTime(date('Y-m-d', strtotime(date('Y-m-d'). ' +14 days')));

                $interval = DateInterval::createFromDateString('1 day');
                $period = new DatePeriod($begin, $interval, $end);

                $first = true;
                $counter = 0;
                $day_counter = 0;
                foreach ($period as $dt) {
                    // if day is weekend, then skip it.
                    $first = false;
                    if (isWeekend($dt->format("l Y-m-d H:i:s"))) {
                        $day_counter++;
                        continue;
                    }
                    // create each hour scheme and give it either the unreserved, reserved or past-room status.
                    // unreserved: open for reservation (green)
                    // reserved: already reserved (red)
                    // past-room: time window is of past
                    $room_tmpl = "";
                    for ($i = 0; $i < 9; $i++) {
                        $room_state = "unreserved"; 
                        if ($first && !hasElapsed(intval(8 + $i))) {
                            $room_state = "past-room";
                            $counter++;
                        }
                        for ($j = 0; $j < count($data); $j++) {
                            if ($dt->format('Y-m-d') == $data[$j]['res_date'] && $data[$j]['res_time_id'] == ($i+1)) {
                                $room_state = "reserved";
                            }
                        }
                        $room_tmpl .= '<div class="room-time ' . $room_state . '"  id="'. $i . '"> ' . intval(8 + $i) . ":00 - " . intval(8 + $i + 1) . ":00 " . '</div>';
                    }
                    
                    // Only able to be 0 if the day shown is today. If it's past any time that a reservation is able to be occurred
                    // then instead of showing a full grey'd out day on the calendar, just skip it.
                    $first = false;
                    if ($counter == 9) {
                        $day_counter++;
                        $counter = 0;
                        continue;
                    }

                    $date_value = $dt->format("D d-m-Y"); 
                    $div_tmpl = "
                        <div class='room-model-container'>
                            <span class='date-text'>" . $date_value . "</span>
                            <div class='room-model' onclick='redirectToReserve(". $queries['id'] . "," . $day_counter . ")'>
                                " . $room_tmpl . 
                                "
                            </div>
                        </div>
                    ";
                    $day_counter++;
                    echo $div_tmpl;
                }
                ?>
        </div>

    </div>
    <script>

        // Function that implements the functionality of sending a user to specific room / day for reservation
        function redirectToReserve(id, day_counter) {
            window.location.href = "reservation.php?id=" + id + "&day=" + day_counter;
        }
    </script>
</body>