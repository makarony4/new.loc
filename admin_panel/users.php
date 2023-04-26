<?php
error_reporting(-1);
require_once('../config/connect.php');
if (!isset($_COOKIE['login'])){
    header('Location: ../index.php');
}
require_once ('../funcs/funcs.php');
if ($_COOKIE['token'] != takeToken($_COOKIE['login'])){
    $_SESSION['missing_token'] = 'Відмовлено в доступі';
    header('Location: ../index.php');
}


$table = 'users';
$items = mysqli_query($connect, "SELECT id,full_name,login, email, avatar FROM users");
$keys = mysqli_fetch_assoc($items);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registered users</title>
    <?php require_once ('../view/table_style.php')?>
</head>
<body>
<INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);">

<h3><a href="index.php">Admin Panel</a></h3>
<h3>Registered Users</h3>
<?php require_once ('../view/td_table.php')?>
</body>
</html>
