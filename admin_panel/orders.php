<?php
session_start();
require_once('../config/connect.php');
require_once ('../funcs/funcs.php');

require_once ('token_generator.php');


if ($_COOKIE['token'] != takeToken($_COOKIE['login'])){
    $_SESSION['missing_token'] = 'Відмовлено в доступі';
    header('Location: ../index.php');
}

if($_COOKIE['role'] ==! 'manager' or $_COOKIE['role'] ==! 'admin'){
    $_SESSION['denyaccess'] = 'Немає прав доступу';
    header('Location: ../../index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders</title>
    <?php require_once ('../view/table_style.php')?>
</head>
<header>
    <?php

    if(isset($_SESSION['alert'])){?>

    <h3><?=$_SESSION['alert']?></h3>

    <?php
    unset($_SESSION['alert']);
    }
    ?>
<?php
    if(isset($_COOKIE['login'])) {?>
        <a href = "vendor/logout.php" class="logout" > Log Out </a >
        <?php
    }
    ?>
    <p>Signed in by:</p><h3><?=$_COOKIE['name']?></h3>

</header>
<body>
<INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);">

<?php if($_COOKIE['role'] == 'admin'){?>
<h1><a href="index.php">Admin Panel</a></h1>
<?php
}
$table = 'orders';
$items = mysqli_query($connect, "SELECT * FROM orders");
$keys = mysqli_fetch_assoc($items);
?>
<h1><a href="../../index.php">Products Page</a></h1>


<h1>Orders</h1>
<?php require_once ('../view/td_table.php')?>

</body>
</html>

