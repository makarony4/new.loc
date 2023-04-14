<?php
session_start();
require_once ('../connect.php');
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
        <a href = "config/logout.php" class="logout" > Log Out </a >
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
?>
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
    $orders = mysqli_query($connect, "SELECT * FROM orders");
    $orders = mysqli_fetch_all($orders);

foreach ($orders as $order){
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
            <td><a href="delete_order.php?id=<?=$order[0]?>">Delete</a></td>
            <td><a href="changestatus.php?id=<?=$order[0]?>&action=on_work">Take to work </a></td>
            <td><a href="changestatus.php?id=<?=$order[0]?>&action=finish">Finish</a></td>
        </tr>
        <?php
}
    ?>
</table><br><br>

</body>
</html>

