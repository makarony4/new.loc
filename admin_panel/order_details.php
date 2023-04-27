<?php
require_once('../config/connect.php');

session_start();

require_once ('token_generator.php');



$table = 'order_details';
if($_COOKIE['role'] ==! 'manager' or $_COOKIE['role'] ==! 'admin'){
    $_SESSION['denyaccess'] = 'Немає прав доступу';
    header('Location: ../../index.php');
}
$order_id = mysqli_real_escape_string($connect, trim($_GET['id']));
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order details</title>
    <?php require_once ('../view/table_style.php')?>

</head>
<body>
<header>
    <INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);">
    <br>
    <a href="orders.php">Back to orders</a>
</header>

<?php

$total = mysqli_query($connect, "select sum(total_price) from order_products where order_id = '$order_id'");
$total = mysqli_fetch_array($total);

$items = mysqli_query($connect, "SELECT * FROM order_products where order_id = '$order_id'");
$keys = mysqli_fetch_assoc($items);
require_once ('../view/td_table.php');
?>
    <tr>
        <td colspan='3'></td>
        <td></b>Total</td>
        <td><?=$total[0]?></td>
    </tr>
</table>
</body>
</html>
