<?php

    INCLUDE_ONCE "./header.php";

    INCLUDE_ONCE "./php/db_connector.php";
    $db = connectToDb();
// Display all employees with group id = 4
    $sql = "SELECT DISTINCT * FROM EMPLOYEES WHERE `group` = '4';";
    $result = $db->query($sql);
    $to_admit = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            array_push($to_admit, $row);
        }
    }
?>

<head>
    <link rel="stylesheet" type="text/css" href="./styles/admittion.css?t=<?= time(); ?>">
</head>

<body>
    <div class="admittion-container">
        <table class="admittion-table">
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>RFIDBadge</th>
            <th>Accept?</th>
            <?php 
            //Diplay all users waiting to get persmisions 
                for ($i = 0; $i < count($to_admit); $i++) {
                    echo 
                        "<form method='POST' action='./php/admittion_post.php'><tr>
                            <td>{$to_admit[$i]['first_name']}</td>
                            <td>{$to_admit[$i]['last_name']}</td>
                            <td>{$to_admit[$i]['email']}</td>
                            <td>{$to_admit[$i]['RFIDBadge']}</td>
                            <td>
                                <input type='submit' name='smbt' class='admit-user' value='Accept'>
                                <input type='hidden' name='useremail' value='" . $to_admit[$i]["email"] . "'>" . "
                            </td>
                    
                        </tr></form>";
                }
            ?>
        </table>
    </div>
</body>