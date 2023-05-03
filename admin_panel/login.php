<?php
session_start();
if(isset($_COOKIE['login'])){
    header('Location:orders.php');
}

$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
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
    <form action="vendor/employeelogin.php" method="post">
        <label>Login</label>
        <input type="text" name="login" placeholder="Press your login">
        <label>Password</label>
        <input type="password" name="password" placeholder="Press your password">
        <label><input type="checkbox" name="rememberme">Remember Me</label>
        <input type="hidden" name="token" value="<?=$_SESSION['csrf_token']?>">
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