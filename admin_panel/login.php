<?php
session_start();
require_once ('../connect.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../auth/assets/css/main.css">
</head>
<body>
<header>

</header>
    <form action="config/employeelogin.php" method="post">
        <label>Login</label>
        <input type="text" name="login" placeholder="Press your login">
        <label>Password</label>
        <input type="password" name="password" placeholder="Press your password">
        <button type="submit">Login</button>

            <?php
            if (isset($_SESSION['faillogin']))
                echo '<p class="msg">'. $_SESSION['faillogin'] . '</p>';
            unset($_SESSION['faillogin']);

        if (isset($_SESSION['message']))
        {
            echo '<p class="msg">'. $_SESSION['message'] . '</p>';
        }
        unset($_SESSION['message']);

        ?>



    </form>

</body>
</html>