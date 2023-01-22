<?php

    // parse query parameters
    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);


    // if id does not correspond to a valid conference room, send the user back to the home page.
    if ($queries['id'] > 21) {
        header("Location: ./");   
    }
?>

<head>
    <link rel="stylesheet" href="">
</head>

<body>
    <div class="selector_container">
        <?php echo $queries['id']; echo $queries['day']     ?>
    </div>
</body>