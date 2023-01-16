<?php

if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header("Location: ./login.php");
}

include_once './php/db_connector.php';
$conn = connectToDb();

$sql = "SELECT DISTINCT * from employees WHERE email = '%s'";
$sql = sprintf($sql, $_SESSION['email']);
$query = $conn->query($sql);
if ($query) {
    $result = $query->fetch_assoc();
    $first_name = $result['first_name'];
    $last_name = $result['last_name'];
}

$em = $_SESSION['email'];
?>

<head>
    <link rel="stylesheet" type="text/css" href="styles/dashboard.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include_once 'header.php'; ?>
        <div class="dashboard-body">
            <div class="profile-container">
                <div class="profile-section">
                    <div class="profile-img">
                        <form onsubmit="console.log('test');return false;" method="POST">
                            <input type="image" style="border-radius: 20%;width: 100%; height: 90%;" name="submit" src="assets/images/dummy_profile2.png" alt="Submit" style="width: 125px;" />
                        </form>
                    </div>
                    <span class="name"><?php echo $first_name . " " . $last_name; ?></span>
                    <span class="email-address"><?php echo $em ?></span>
                </div>
                <div class="edit-section">
                    <span class="edit-title">Edit your Profile</span>
                    <form onsubmit="return verifyPost(event)" action="php/dashboard_post" method="POST">
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
                                <input type="text" name="rfid" placeholder="Edit RFID Badge">
                            </div>
                        </div>
                        <div class="dashboard_submit">
                            <input type="submit" value="Edit Profile">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function verifyPost(e) {
            //e.preventDefault();
            // console.log(e);
            // return false;
        }
    </script>

</body>