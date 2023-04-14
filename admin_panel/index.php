<?php
error_reporting(-1);
require_once('../config/connect.php');
session_start();



$products = mysqli_query($connect,"SELECT * FROM `products`");
$products = mysqli_fetch_all($products);

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
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<style>
    th,td{
        padding: 10px;
    }
    th{
        background:#606060;
        color: white;
    }

    td{
        background: bisque;
    }
    a{
        color: darkslateblue;
    }
</style>
<header>
    <?php
    if(isset($_COOKIE['login'])) {?>
        <a href = "vendor/logout.php" class="logout" > Log Out </a >
    <?php
    }
    ?>
    <h3><?=$_COOKIE['name']?></h3>
</header>
<body>
<h1><a href="orders.php" class="link-primary">Orders</a></h1>
<h2><a href="users.php">Users</a></h2>

<a href = "../index.php">Products page</a>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Price</th>
        <th>Description</th>
        <th>Photo</th>
        <th><h2><a href="create_product.php">Create Product</a></h2>
        </th>

    </tr>

    <?php

    foreach ($products as $product) {
        ?>
    <tr>
        <td><?=$product[0]?></td>
        <td><?=$product[1]?></td>
        <td><?=$product[2]?></td>
        <td><?=$product[3]?></td>
        <td><img src="<?=$product[4]?>" width="100" height="100"></td>
        <td><a href="update.php?id=<?=mysqli_real_escape_string($connect,$product[0])?>">Update</a></td>
        <td><a href="delete.php?id=<?=mysqli_real_escape_string($connect, $product[0])?>">Delete</a> </td>
        <td><a href="product_stats.php?id=<?=$product[0]?>">Stats by product</a></td>
    </tr>
    <?php
}
    ?>
</table><br><br>
</body>
</html>