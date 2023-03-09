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
    $quantity = $value['quantity'];
    $id = $value['id'];

    $user_data = mysqli_query($connect, "INSERT INTO orders (full_name, `number` , city, address, quantity, product_id, product_title, product_price) VALUES ('$full_name', '$number', '$city', '$address', '$quantity', '$id', '$product_title', '$product_price')");
    }
}
//перенаправляємо на сторінку подяки, відміняємо сесію корзини
header('Location: ../typage.php');
unset($_SESSION['cart']);
    ?>
