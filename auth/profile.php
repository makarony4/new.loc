<?php
session_start();
require_once ('../connect.php');
if(!$_SESSION['user']){
    header('Location: index.php');
}
$email = $_SESSION['user']['email'];

$orders = mysqli_query($connect, "SELECT * FROM orders where email = '$email'");
$orders = mysqli_fetch_all($orders);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>My profile</title>
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
<form>
    <img src="<?= $_SESSION['user']['avatar']?>" width="100" alt="">
    <h2><?=$_SESSION['user']['full_name']?></h2>
    <a href="#"><?=$_SESSION['user']['email']?></a>
    <a href="vendor/logout.php" class="logout">Log Out</a>
</form>
<h3>Orders History</h3>
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
foreach ($orders as $order) {
    if ($order[6] == 0) {
        $status = 'New';
    } elseif ($order[6] == 1) {
        $status = 'Pending';
    } else {
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
    <td><a href="orders_history.php?id=<?=$order[0]?>">Details</a></td>
</tr>
<?php
}
    ?>
</table><br><br>
</body>
</html>
