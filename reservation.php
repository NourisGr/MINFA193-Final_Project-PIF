<?php
    if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // If session is not set, send user to login
    if (!isset($_SESSION['email'])) {
        header('location: ./login.php');
    }

    require_once './header.php';

    // Get query parameters as array.
    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);

    // If id or day paramter doesn't exist, send user back to index.
    if (!isset($queries['id']) || !isset($queries['day'])) {
        header('location: ./index.php');
    }

    // Calculate date to reserve
    $reservation_date = new DateTime(date('Y-m-d', strtotime(date('Y-m-d') . ' +' . $queries['day'] . 'days')));
    INCLUDE_ONCE './php/db_connector.php';

    // Establish db connection and get data for current room.
    $db = connectToDb();
    $sql = "SELECT * FROM conference_rooms";
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

    // Prepare sql query to insert reservation
    $d = $reservation_date->format('Y-m-d');
    $sql = "SELECT DISTINCT * FROM list_of_reservations INNER JOIN info_reservation
            ON info_reservation.res_id = list_of_reservations.res_id WHERE
            info_reservation.res_room = '{$queries['id']}' AND info_reservation.res_date = '{$d}'";

    // Prepare times for reservation insert and commit query
    $r_dates = [];
    $res = $db->query($sql);
    if ($res) {
        while ($row = $res->fetch_assoc()) {
            array_push($r_dates, $row['res_time_id']);
        }
    }

    // Send reservation to be posted
    $action_url = "./php/post_reservation.php?room_id=" . $queries['id'] . "&date=" . $queries['day'];
?>

<head>
    <link rel="stylesheet" href="./styles/reservation.css?t=<?= time(); ?>">
</head>

<body class="reservations">
    <div class="reservation-container">
        <div class="conference-room-info">
            <div class="info-container">
                <span>Date: <span class="info-text"><?php echo $reservation_date->format("d-m-Y"); ?></span></span>
                <span>Room Number: <span class="info-text"><?php echo $ro_num; ?></span></span>
                <span>Capacity: <span class="info-text"><?php echo $ro_cap; ?></span></span>
                <span>Description: <span class="info-text"><?php echo $ro_desc; ?></span></span>
            </div>
        </div>
        <div class="reservation-content">
            <form action="<?php echo $action_url; ?>" method="POST">
                <div class="reservation-form">
                    <span class="info-text purpose-text">Purpose </span>
                        <textarea name="purpose" autofocus maxlength="255" cols="60" rows="4">
                        </textarea>
                    <input class="reservation-post-btn" type="submit" onclick="validatePost(event)" value="Make Reservation">
                </div>
                <div class="reservation-ui">
                    <div class="slot-mesh">
                        <?php 
                            // Code to generate form values for 9 available times
                            $to_print = "";
                            for ($i = 0; $i < 9; $i++) {
                                $eval = !in_array(($i + 1), $r_dates);
                                $classname =  $eval ? "available" : "unavailable";
                                $onclick = $eval ? "onclick='selectTime(" . ($i + 8) . ")'" : "";
                                $to_print .= "<div name='' id='" . ($i + 8) . "'" . $onclick . "value='" . ($i + 8) . "'class='slot ". $classname . "'>" . ($i + 8) . ":00 - " . ($i + 9) . ":00</div>";
                                $to_print .= "<input type='hidden' name='". ($i + 8) . "' id='inp" . ($i + 8) . "'value=''>";
                            }
                            echo $to_print;
                        ?>
                    </div>
                </div>
            </form>
        </div>
        <script>
            let selectedTimes = [];
            let activeItems = [];

            // Selects / deselects time clicked by user
            function selectTime(time) {
                selectedTimes.push(time);
                
                Array.from(document.getElementsByClassName("slot")).forEach((d) => {
                    if (d.name !== "unavaible") {
                        if (parseInt(d.id) == time) {
                            if (activeItems.includes(parseInt(d.id))) {
                                activeItems[activeItems.indexOf(parseInt(d.id))] = -1;
                                d.setAttribute("name", "");
                                document.getElementById((`inp${parseInt(d.id)}`)).value = "";
                            }
                            else {
                                if (parseInt(d.id) == time) {
                                    activeItems.push(parseInt(d.id));
                                    d.setAttribute("name", parseInt(d.id));
                                    document.getElementById((`inp${parseInt(d.id)}`)).value = parseInt(d.id);
                                }
                            } 
                        }
                    }
                })
            }

            // Validates post request.
            function validatePost(e) {
                const elements = document.querySelectorAll("input[type='hidden']");
                flag = false;
                for (let i = 0; i < elements.length && !flag; i++) {
                    console.log(`i = ${i} value = ${elements[i].value}`);
                    flag = elements[i].value.length !== 0;
                }

                if (!flag) {
                    e.preventDefault();
                } else {
                    alert("Your reservation has been submitted successfully");
                }
            }
    </script>
    </div>
</body>