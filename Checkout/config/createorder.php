<?php
session_start();
require_once ('../../connect.php');
$full_name = $_POST['full_name'];
$city = $_POST['city'];
$address = $_POST['address'];
$number = $_POST['number'];

$user_data = mysqli_query($connect, "INSERT INTO orders (full_name, `number` , city, address) VALUES ('$full_name', '$number', '$city', '$address')");
$last_order_id= (mysqli_insert_id($connect));


if(!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        $product_id = $value['id'];
        $quantity = $value['quantity'];
        $product_title = $value['title'];
        $product_price = $value['price'];
        $total_price = $value ['quantity'] * $value['price'];




        mysqli_query($connect, "INSERT INTO order_products (order_id, product_id, count, product_title, product_price, total_price) values ('$last_order_id', '$product_id', '$quantity', '$product_title', '$product_price', '$total_price')");

    }
}

//перенаправляємо на сторінку подяки, відміняємо сесію корзини
header('Location: ../typage.php');
unset($_SESSION['cart']);
    ?>
