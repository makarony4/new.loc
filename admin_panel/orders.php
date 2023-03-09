<?php
session_start();
require_once ('../connect.php');



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders</title>
    <style>
        th,td{
            padding: 10px;
        }
        th{
            background:#606060;
        }

        td{
            background: bisque;
        }
    </style>
</head>
<body>
<h1><a href="index.php">Admin Panel</a></h1>
<h1><a href="../../index.php">Products Page</a></h1>


<h1>Orders</h1>
<table>
    <tr>
        <th>OrderID</th>
        <th>FUll name</th>
        <th>Number</th>
        <th>City</th>
        <th>Address</th>
        <th>Product ID</th>
        <th>Quantity</th>
        <th>Product</th>
        <th>Price</th>
        <th>Order Date</th>

    </tr>

    <?php
    $orders = mysqli_query($connect,"SELECT * FROM `orders`");
    $products = mysqli_query($connect, "SELECT * FROM products");
    $orders = mysqli_fetch_all($orders);
    $products = mysqli_fetch_all($products);



    foreach ($orders as $order){
        echo"<pre>";
        print_r($order);
        echo"</pre>";
            ?>
        <tr>
            <td><?=$order[0]?></td>
            <td><?=$order[1]?></td>
            <td>+380<?=$order[2]?></td>
            <td><?=$order[3]?></td>
            <td><?=$order[4]?></td>
            <td><?=$order[9]?></td>
            <td><?=$order[6]?></td>
            <td><?=$order[7]?></td>
            <td><?=$order[8]?></td>
            <td><?=$order[5]?></td>
            

        </tr>
        <?php
    }
    ?>
</table><br><br>
</body>
</html>

