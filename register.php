<?php
    if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // If session is already set, go back to index.
    if (isset($_SESSION['email'])) {
        header('Location: ./index.php');
    }

    include_once './php/db_connector.php';
    $conn = connectToDb();
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="styles/register.css">
    <script>
        // Verify user input on the client side
        function verifyRegister() {
            const error_element = document.querySelector(".error-msg");
            const first_name = document.getElementsByName("first_name")[0].value;
            const last_name = document.getElementsByName("last_name")[0].value;

            if (first_name.length < 3 || first_name.length > 32) {
               error_element.innerHTML = "First Name must be between 3 and 32 characters.";
            } else if(last_name.length < 3 || last_name.length > 32) {
                error_element.innerHTML = "Last Name must be between 3 and 32 characters.";
            } else {
                const password = document.getElementsByName("password")[0].value;
                if (password.length < 4 || password.length > 32) {
                    error_element.innerHTML = "Password must be between 4 and 32 characters.";
                }
            }
        }
    </script>
</head>

<body>
    <div class="register-box">
        <h2>Register</h2>
        <form method="POST" action="./php/register_post.php">
            <div class="user-box">
                <input type="text" name="first_name" required autocomplete="off">
                <label>First Name</label>
            </div>
            <div class="user-box">
                <input type="text" name="last_name" required autocomplete="off">
                <label>Last Name</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required autocomplete="off">
                <label>Password</label>
            </div>
            <div class="user-box">
                <input type="email" name="email" required autocomplete="off">
                <label>Email Address</label>
            </div>
            <div class="user-box rfid-box">     
                <span class="rfid-text">Your RFID Key</span>
                <select class="form-select" name="rfid">
                    <?php
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
            <div class="error error-off">
                <span class="error-msg"></span>
            </div>
            <div class="submit-btn">
                <input type="submit" value="Register" onclick="verifyRegister()">
            </div>
            <div class="redirect-container">
                <span class="redirect-txt">Already have an account? <a href="./login.php" class="redirect-a">Login now.</a></span>
            </div>
        </form>
    </div>
</body>

</html>