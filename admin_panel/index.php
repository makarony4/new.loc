<?php
require_once('../config/connect.php');
require_once ('../funcs/funcs.php');
session_start();
if(!isset($_COOKIE['login'])){
    $_SESSION['message'] = 'Немає прав доступу';
    header("location:javascript:history.go(-1)");
}

if(isset($_COOKIE['login'])){
    if($_COOKIE['role'] !== 'admin'){
        $_SESSION['denyaccess'] = 'Недостатньо прав доступу';
        header("location:javascript:history.go(-1)");
    }
}
if ($_COOKIE['token'] != takeToken($_COOKIE['login'])){
 $_SESSION['missing_token'] = 'Відмовлено в доступі';
 header('Location: ../index.php');
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<?php require_once ('../view/table_style.php')?>
<header>
    <?php
    if(isset($_COOKIE['login'])) {?>
        <a href = "vendor/logout.php" class="logout" > Log Out </a >
    <?php
    }
    $table = 'products';
    $items = mysqli_query($connect, "SELECT * FROM products");
    $keys = mysqli_fetch_assoc($items);
    ?>
    <h3><?=$_COOKIE['name']?></h3>
</header>
<body>
<h1><a href="orders.php" class="link-primary">Orders</a></h1>
<h2><a href="users.php">Users</a></h2>

<a href = "../index.php">Products page</a>

<?php require_once ('../view/td_table.php') ?>
</body>
</html>
