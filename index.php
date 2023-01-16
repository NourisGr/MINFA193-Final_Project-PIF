<?php
    if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['email'])) {
        header("Location: ./login");    
    }

    INCLUDE_ONCE './header.php';
?>

<head>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <div class="conference-rooms">
        <?php 
            for ($i = 0; $i < 50; $i++) {
                if ($i % 2 == 0) {
                    echo 
                    "<div class='room closed' id='" . ($i + 1) . "'onclick='test(this)'>
                        Room " . ($i + 1) 
                    . " </div>";
                } else {
                    echo 
                    "<div class='room open' id='" . ($i + 1) . "'onclick='test(this)'>
                        Room " . ($i + 1) 
                    . " </div>";
                }
            }
        ?>
    </div>
    <script>
        function test(el) {
            window.location.href = './room?id=' + el.id;
        }
    </script>
</body>

