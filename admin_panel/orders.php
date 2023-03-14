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
        <th>Order Date</th>
        <th>Order Status</th>
    </tr>

    <?php
//    $orders = mysqli_query($connect,"select * from order_products inner join products on order_products.product_id= products.id inner join orders on order_products.order_id = orders.id;
//");
    $orders = mysqli_query($connect, "SELECT * FROM orders");

    $orders = mysqli_fetch_all($orders);




foreach ($orders as $order){
//    mysqli_query($connect, "select * from order_products where order_id in (select order_id from order_products group by order_id having count(*) >1);");
if ($order[6] == 0){
   $status = 'New';
}
elseif ($order[6] == 1){
    $status = 'Pending';
}
else{
    $status = 'Done';
}
    ?>
        <tr>
            <td><?=$order[0]?></td>
            <td><?=$order[1]?></td>
            <td>+380<?=$order[2]?></td>
            <td><?=$order[3]?></td>
            <td><?=$order[4]?></td>
            <td><?=$order[5]?></td>
            <td><?=$status?></td>
            <td><a href="order_details.php?id=<?=$order[0]?>">Details</a></td>
        </tr>
        <?php
}
    ?>
</table><br><br>

</body>
</html>

