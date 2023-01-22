<?php
    if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // If session isn't set, go back to login
    if (!isset($_SESSION['email'])) {
        header("Location: ./login.php");    
    }

    INCLUDE_ONCE './header.php';

    INCLUDE_ONCE './php/db_connector.php';
    $db = connectToDb();

    // Prepare and execute sql query to verify user group.
    // If user is not admitted (user_group = 4) send him to dashboard.
    $sql = "SELECT DISTINCT * FROM employees WHERE email = '%s'";
    $sql = sprintf($sql, $_SESSION['email']);
    $result = $db->query($sql);
    if ($result) {
        $data = $result->fetch_assoc();
        if ($data['group'] == 4) {
            header("Location: ./dashboard.php");
        }
    }

    // Load conference rooms from database
    $sql = "SELECT DISTINCT * FROM conference_rooms";
    $result = $db->query($sql);
    $incr = 0;
    if ($result) {
        $incr = $result->num_rows;
    }
?>

<head>
    <link rel="stylesheet" href="./styles/style.css?t=<?= time(); ?>">
</head>
<body>
    <div class="conference-rooms">
        <?php 
            for ($i = 0; $i < $incr; $i++) {
                $sql = "SELECT * FROM conference_rooms";
                $result = $db->query($sql);
                $ro_num = "None";
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['room_id'] == $i + 1) {
                            $ro_num = $row['room_number'];
                        }
                    }
                }
                echo 
                "<div class='room' id='" . ($i + 1) . "'onclick='goTo(this)'>
                    Room: " . ($ro_num) 
                . " </div>";
            }
        ?>
    </div>
    <script>
        function goTo(el) {
            window.location.href = './room.php?id=' + el.id;
        }
    </script>
</body>

