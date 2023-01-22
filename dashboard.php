<?php

    if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // If session isn't set, go back to login.
    if (!isset($_SESSION['email'])) {
        header("Location: ./login.php");
    }

    INCLUDE_ONCE './php/db_connector.php';
    $conn = connectToDb();

    // Find first name and last name of user from query to display on Dashboard.
    $sql = "SELECT DISTINCT * from employees WHERE email = '%s'";
    $sql = sprintf($sql, $_SESSION['email']);
    $query = $conn->query($sql);
    if ($query) {
        $result = $query->fetch_assoc();
        $first_name = $result['first_name'];
        $last_name = $result['last_name'];
    }

    // Get email of user fro session to display on Dashboard.
    $em = $_SESSION['email'];
?>

<head>
    <link rel="stylesheet" type="text/css" href="styles/dashboard.css?t=<?= time(); ?>">
</head>

<body>
    <div class="dashboard-container">
        <?php INCLUDE_ONCE 'header.php'; ?>
        <div class="dashboard-body">
            <div class="profile-container">
                <div class="profile-section">
                    <span class="name"><?php echo $first_name . " " . $last_name; ?></span>
                    <span class="email-address"><?php echo $em ?></span>
                </div>
                <div class="edit-section">
                    <span class="edit-title">Edit your Profile</span>
                    <form onsubmit="return verifyPost(event)" action="php/dashboard_post.php" method="POST">
                        <div class="dashboard-form">
                            <div class="dashboard_firstname">
                                <label for="firstname">New First Name </label>
                                <input type="text" name="firstname" placeholder="Edit First Name">
                            </div>
                            <div class="dashboard_surname">
                                <label for="surname">New Surname </label>
                                <input type="text" name="surname" placeholder="Edit Surname">
                            </div>
                            <div class="dashboard_email">
                                <label for="email">New Email Address </label>
                                <input type="email" name="email" placeholder="Edit Email">
                            </div>
                            <div class="dashboard_password">
                                <label for="password">New Password </label>
                                <input type="password" name="password" placeholder="Edit Password">
                            </div>
                            <div class="dashboard_rfid">
                                <label for="rfid">New RFID Badge </label>
                             
                                <select class="dashboard-rfid-select" name="rfid">
                                    <?php
                                    //Display all not already used Badge Id
                                        $sqlRFID = $conn->prepare("SELECT * FROM badge WHERE Badgeid NOT IN (SELECT RFIDBadge FROM employees) ORDER BY Badgeid");
                                        $sqlRFID->execute();
                                        $result = $sqlRFID->get_result();

                                        while ($row2 = $result->fetch_assoc()) {
                                            $v = $row2["Badgeid"];
                                            echo '<option value="'. $v .'"> '. $v. '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <p class="error-msg"></p>
                        <div class="dashboard_submit">
                            <input type="submit" value="Edit Profile">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>

        // Verify post and display error message 
        function verifyPost(e) {
            const error_element = document.querySelector(".error-msg");
            const first_name = document.getElementsByName("firstname")[0].value;
            const last_name = document.getElementsByName("surname")[0].value;

            if (first_name.length !== 0 && (first_name.length < 3 || first_name.length > 32)) {
               error_element.innerHTML = "First Name must be between 3 and 32 characters.";
               e.preventDefault();
            } else if (last_name.length !== 0 && (last_name.length < 3 || last_name.length > 32)) {
                error_element.innerHTML = "Last Name must be between 3 and 32 characters.";
                e.preventDefault();
            } else {
                const password = document.getElementsByName("password")[0].value;
                if (password.length !== 0 && (password.length < 4 || password.length > 32)) {
                    error_element.innerHTML = "Password must be between 4 and 32 characters.";
                    e.preventDefault();
                }
            }
        }
    </script>

</body>
