<?php
require_once ('../connect.php');
$ttl = mysqli_query($connect, "SELECT sum(total_price) from order_products as TTL");
$ttl = mysqli_fetch_assoc($ttl);
$avg = mysqli_query($connect, "SELECT avg(total_price) as average from order_products");
$row = mysqli_fetch_assoc($avg);
$order_count = mysqli_query($connect, "SELECT count(id) as order_count FROM orders");
$count = mysqli_fetch_assoc($order_count);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stats</title>
    <style>
        html {
            font-family: Tahoma, Geneva, sans-serif;
            padding: 10px;
        }
        table {
            border-collapse: collapse;
            width: 500px;
        }
        th {
            background-color: #54585d;
            border: 1px solid #54585d;
        }
        th:hover {
            background-color: #64686e;
        }
        th a {
            display: block;
            text-decoration:none;
            padding: 10px;
            color: #ffffff;
            font-weight: bold;
            font-size: 13px;
        }
        th a i {
            margin-left: 5px;
            color: rgba(255,255,255,0.4);
        }
        td {
            padding: 10px;
            color: #636363;
            border: 1px solid #dddfe1;
        }
        tr {
            background-color: #ffffff;
        }
        tr .highlight {
            background-color: #f9fafb;
        }
    </style>
</head>
<body>
<table>
    <tr>
    <th>TTl orders sum</th>
    <th>AVG</th>
    <th>Order Count</th>
    </tr>
    <tr>
        <td><?=$ttl['sum(total_price)']?></td>
        <td><?=$row['average']?></td>
        <td><a href="orders.php"><?=$count['order_count']?></a></td>
    </tr>
</table>
</body>
</html>
