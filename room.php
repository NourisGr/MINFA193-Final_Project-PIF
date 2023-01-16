<?php

    INCLUDE_ONCE './header.php';

    if (!isset($_SESSION['email'])) {
        header("Location: ./login.php");    
    }

    // parse query parameters
    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);



    // if id does not correspond to a valid conference room, send the user back to the home page.
    if ($queries['id'] > 50) {
        header("Location: ./.php");   
    }

    // returns: <bool> - Check if date given is weekend
    function isWeekend($date) {
        return (date('N', strtotime($date)) >= 6);
    }

    // returns: <bool> = Check if a day's hour has elapsed based on given hour (function parameter)
    function hasElapsed($hour) {
        return $hour >= date('H');
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
            <span class="annotation">Room number:</span> <span class="room-number"><?php echo $queries['id']; ?></span>
            <span class="annotation">Room capacity:</span> <span class="room-capacity">20</span>
            <span class="annotation">Room Description:</span> <span class="room-description">The Room has a projector and 20 laptops with docking stations</span>
        </div>
        <div class="room-days-container">
            <?php
                // to-do: if current hour is >= 17, then the day is flagged as past and is not shown.
                // but it doesn't add the lost day to the foreseeable days. (+13 instead of +14).
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
                        $room_tmpl .= '<div class="room-time ' . $room_state . '"  id="'. $i . '"onclick="handleReservation(this)"> ' . intval(8 + $i) . ":00 - " . intval(8 + $i + 1) . ":00 " . '</div>';
                    }
                    
                    // Only able to be 0 if the day shown is today. If it's past any time that a reservation is able to be occurred
                    // then instead of showing a full grey'd out day on the calendar, just skip it.
                    if ($counter == 9) {
                        $counter = 0;
                        continue;
                    }

                    $date_value = $dt->format("D d-m-Y"); 
                    $div_tmpl = "
                        <div class='room-model-container'>
                            <span class='date-text'>" . $date_value . "</span>
                            <div class='room-model' onclick='test(". $queries['id'] . "," . $day_counter . ")'>
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
        function handleReservation(el) {
            const id = el.id;
            const time_dom = document.getElementsByClassName("room-time");
            const time_windows = time_dom.length;
        }

        function test(id, day_counter) {
            window.location.href = "reservation?id=" + id + "&day=" + day_counter;
        }
    </script>
</body>