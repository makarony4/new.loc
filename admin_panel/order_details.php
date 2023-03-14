<?php
require_once ('../connect.php');

session_start();

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
</head>
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
<body>
<a href="orders.php">Back to orders</a>
<table>
    <tr>
        <th>Order ID</th>
        <th>Customer name</th>
        <th>Customer phone number</th>
        <th>Customer city</th>
        <th>Customer address</th>
        <th>Order Date</th>
    </tr>

    <?php
    //    $orders = mysqli_query($connect,"select * from order_products inner join products on order_products.product_id= products.id inner join orders on order_products.order_id = orders.id;
    //");
    $orders = mysqli_query($connect, "SELECT * FROM orders where id = '$order_id' ");

    $orders = mysqli_fetch_assoc($orders);

    $total = mysqli_query($connect, "select sum(total_price) from order_products where order_id = '$order_id'");
    $total = mysqli_fetch_array($total);


    //foreach ($orders as $order){
    //    mysqli_query($connect, "select * from order_products where order_id in (select order_id from order_products group by order_id having count(*) >1);");

    ?>
    <tr>
        <td><?=$orders['id']?></td>
        <td><?=$orders['full_name']?></td>
        <td>+380<?=$orders['number']?></td>
        <td><?=$orders['city']?></td>
        <td><?=$orders['address']?></td>
        <td><?=$orders['order_date']?></td>
    </tr>
    <?php
    //   }
    ?>
</table>
<br><br>

<?php
//$ordered_products = mysqli_query($connect, "select * from order_products inner join products on product_id = products.id WHERE order_id = '$order_id';");
$ordered_products = mysqli_query($connect, "SELECT * FROM order_products where order_id = '$order_id'");
$ordered_products = mysqli_fetch_all($ordered_products);

//if (isset($_POST['status'])){
//    if(!empty($_POST['status'])){
//        $status = $_POST['status'];
//        mysqli_query($connect, "UPDATE order_products set order_status = '$status' where order_id = '$order_id'");
//    }
//}

?>


<table>
    <tr>
        <th>Product id</th>
        <th>Product</th>
        <th>Price of 1 pc</th>
        <th>Quantity</th>
        <th>Total price</th>
    </tr>
    <?php foreach ($ordered_products as $ordered_product){

        ?>
    <tr>
        <td><?=$ordered_product[1]?></td>
        <td><?=$ordered_product[3]?></td>
        <td><?=$ordered_product[4]?></td>
        <td><?=$ordered_product[2]?></td>
        <td><?=$ordered_product[5]?></td>
    </tr>

        <?php
    }
    ?>
    <tr>
        <td colspan='3'></td>
        <td></b>Total</td>
        <td><?=$total[0]?></td>
    </tr>
</table>
</body>
</html>
