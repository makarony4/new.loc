<?php
session_start();
require_once ('../../connect.php');
$full_name = $_POST['full_name'];
$city = $_POST['city'];
$address = $_POST['address'];
$number = $_POST['number'];

if(!empty($_SESSION['cart'])){
foreach ($_SESSION['cart'] as $key => $value) {
    $product_title = $value['title'];
    $product_price = $value['price'];

    $user_data = mysqli_query($connect, "INSERT INTO orders (full_name, `number` , city, address, product_title, product_price) VALUES ('$full_name', '$number', '$city', '$address', '$product_title', '$product_price')");
    }
}
    ?>

<pre>
    <?php  print_r($_POST)?>
</pre>