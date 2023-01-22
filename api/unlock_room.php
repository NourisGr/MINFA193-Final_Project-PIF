<?php

// Room query: room that the employee is attempting to open
// RFID Hex: the hex of the employee's key

// parse query parameters
$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);

if (!isset($queries['room_id']) || !isset($queries['rfid'])) {
    exit();
}

// Room and key queries
$r_id = $queries['room_id'];
$rfid_key = $queries['rfid'];

include_once "../php/db_connector.php";
$conn = connectToDb();

// Convert HEX query to BadgeID for later use
$sql = "SELECT DISTINCT `Badgeid` from badge WHERE `RFIDKey` = '${rfid_key}'";

// If not found, exit.
$result = $conn->query($sql);
if (!$result) {
    exit();
}

$badge_id = $result->fetch_assoc()['Badgeid'];

// Get all reservations done by the employee with this badge on this specific day.
$t = date("Y-m-d");
$sql = "SELECT DISTINCT * FROM `info_reservation` INNER JOIN `employees` ON
        employees.email = info_reservation.res_userEmail WHERE employees.RFIDBadge = '{$badge_id}' 
        AND info_reservation.res_room = '${r_id}'
        AND res_date = '{$t}';";

// If no reservations where made, exit.
$result = $conn->query($sql);
if (!$result) {
    exit();
}

// Get All Rooms that are reserved by this user, for this day.
$rooms = [];
while ($row = $result->fetch_assoc()) {
    array_push($rooms, $row);
}

// Get all times for reservations by this user for this day, per room.
$res_times = [];
for ($i = 0; $i < count($rooms); $i++) {
    $res_ids = [];
    $t = $rooms[$i]['res_id'];
    $sql = "SELECT * FROM list_of_reservations INNER JOIN info_reservation ON list_of_reservations.res_id = info_reservation.res_id
    WHERE list_of_reservations.res_id = '{$t}'";
    $res = $conn->query($sql);
    if ($res) {
        while ($row = $res->fetch_assoc()) {
            array_push($res_ids, $row['res_time_id']);
        }
    }

    array_push($res_times, $res_ids);
}

// Filter, find only rooms with valid reservation times.
$final = array_filter($res_times, function($value) {
    return count($value) > 0;
});

// If the count is greater than 0, then the room is reserved by this user for this time.
header('Content-Type: application/json; charset=utf-8');
if (count($res_times) > 0) {
    echo json_encode("accepted: yes"); // the response is sent back to the browser
} 
// Else not.
else {
    echo json_encode("accepted: no");
}



?>