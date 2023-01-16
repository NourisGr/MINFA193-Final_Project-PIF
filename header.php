<?php
    if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>  

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>DataCorp S.A </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./styles/header.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <a class="logo" href="./"><img src="assets/images/DATA-CORP2.png" alt="logo"></a>
            <nav>
                <ul class="nav__links">
                    <li><a href="./">Conference Rooms</a></li>
                    <li><a href="./dashboard">Dashboard</a></li>
                </ul>
            </nav>
            
            <p class="menu cta">Menu</p>
            <div class="logout-form">
            <?php
                if (isset($_SESSION['email'])) {
                    echo '
                        <form method="POST" action="php/logout">
                            <input class="logout" type="submit" value="Log out">
                        </form>
                    ';
                }
            ?>
            </div>
        </header>
        <div class="overlay">
            <a class="close">&times;</a>
            <div class="overlay__content">
                <a href="./">Conference Rooms</a>
                <a href="./dashboard">Dashboard</a>
            </div>
        </div>
        <script type="text/javascript" src="./js/mobile.js"></script>
    </body>
</html>