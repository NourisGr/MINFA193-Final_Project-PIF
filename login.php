<?php

    if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // If session is already set, go back to index
    if (isset($_SESSION['email'])) {
        header('Location: ./index.php');
    }
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles/register.css">
    <script>
        // Verify user input, on the client side.
        function verifyLogin(event) {
            const error_element = document.querySelector(".error-msg");
            error_element.innerHTML = "";
            const password = document.getElementsByName("password")[0].value;
            if (password.length < 4 || password.length > 32) {
                error_element.innerHTML = "Password must be between 4 and 32 characters.";
                event.preventDefault();
            }
        }
    </script>
</head>

<body>
    <div class="register-box">
        <h2>Login</h2>
        <form method="POST" action="./php/login_post.php">
            <div class="user-box">
                <input type="email" name="email" required autocomplete="off">
                <label>Email Address</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required autocomplete="off">
                <label>Password</label>
            </div>
            <div class="error error-off">
                <span class="error-msg"></span>
            </div>
            <div class="submit-btn">
                <input type="submit" value="Login" onclick="verifyLogin(event);"> 
            </div>
            <div class="redirect-container">
                <span class="redirect-txt">Don't have an account? <a href="./register.php" class="redirect-a">Create one now.</a></span>
            </div>
        </form>
    </div>
</body>

</html>