<?php
//require_once('../config/connect.php');
require_once ('../vendor/autoload.php');
session_start();

$order_details = new \MyApp\db();

$table = 'order_details';
if($_COOKIE['role'] ==! 'manager' or $_COOKIE['role'] ==! 'admin'){
    $_SESSION['denyaccess'] = 'Немає прав доступу';
    header('Location: ../../index.php');
}
//$order_id = mysqli_real_escape_string($connect, trim($_GET['id']));
$order_id = $order_details->mysqli->real_escape_string($_GET['id']);

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
$query = $order_details->select('order_products','*', 'order_id', $order_id);
$items = $order_details->sql;
$total_price_query = $order_details->select('order_products','sum(total_price)', 'order_id', $order_id);
$result = $order_details->sql;
$total_result = mysqli_fetch_assoc($result);

require_once ('../view/td_table.php');
?>
    <tr>
        <td colspan='3'></td>
        <td></b>Total</td>
        <td><?=$total_result['sum(total_price)']?></td>
    </tr>
</table>
</body>
</html>
