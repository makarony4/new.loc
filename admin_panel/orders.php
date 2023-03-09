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
<h1>Orders</h1>
<table>
    <tr>
        <th>ID</th>
        <th>FUll name</th>
        <th>Number</th>
        <th>City</th>
        <th>Address</th>
        <th>Product</th>
        <th>Price</th>
        <th>Order Date</th>

    </tr>

    <?php
    $orders = mysqli_query($connect,"SELECT * FROM `orders`");
    $orders = mysqli_fetch_all($orders);

    foreach ($orders as $order) {
        ?>
        <tr>
            <td><?=$order[0]?></td>
            <td><?=$order[1]?></td>
            <td><?=$order[2]?></td>
            <td><?=$order[3]?></td>
            <td><?=$order[4]?></td>
            <td><?=$order[5]?></td>
            <td><?=$order[6]?></td>
            <td><?=$order[7]?></td>
            
            <td><a href="delete.php?id=<?=$order[0]?>">Delete</a> </td>
        </tr>
        <?php
    }
    ?>
</table><br><br>
</body>
</html>

