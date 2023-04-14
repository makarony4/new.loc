<?php
require_once('../config/connect.php');
if (!isset($_COOKIE['login'])){
    header('Location: ../index.php');
}
$query= mysqli_query($connect, "SELECT * from users");
$query = mysqli_fetch_all($query);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registered users</title>
    <?php require_once ('../view/table_style.php')?>
</head>
<body>
<INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);">

<h3><a href="index.php">Admin Panel</a></h3>
<h3>Registered Users</h3>
<table>
    <tr>
        <th>ID</th>
        <th>FUll Name</th>
        <th>Email</th>
        <th>Login</th>
        <th>User Orders</th>
    </tr>
    <tr>
        <?php
        foreach ($query as $item) {
        $avatar = "../auth/" . $item[3];

        ?>
        <td><?=$item[0]?></td>
        <td><?=$item[1]?></td>
        <td><?=$item[2]?></td>
        <td><?=$item[4]?></td>
        <td><a href="user_orders.php?email=<?=$item[2]?>">User orders</a></td>
        <td><a href="vendor/delete_user.php?id=<?=mysqli_real_escape_string($connect, $item[0])?>">Delete</a></td>
    </tr>
    <?php
    }
    ?>
</table>
</body>
</html>
