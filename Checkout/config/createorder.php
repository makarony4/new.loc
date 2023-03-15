<?php
session_start();
require_once ('../../connect.php');
$full_name = $_POST['full_name'];
$city = $_POST['city'];
$address = $_POST['address'];
$number = $_POST['number'];


$sql = "INSERT INTO orders (full_name, `number` , city, address) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "siss", $full_name, $number, $city, $address);
mysqli_stmt_execute($stmt);
$last_order_id= (mysqli_insert_id($connect));
mysqli_close($connect);



if(!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        $product_id = $value['id'];
        $quantity = $value['quantity'];
        $product_title = $value['title'];
        $product_price = $value['price'];
        $total_price = $value ['quantity'] * $value['price'];

//треба затрімити отримувані результати з форми , так як стмт дозволяє добавити лише один раз
        $sql_products = "INSERT INTO order_products (order_id, product_id, count, product_title, product_price, total_price) values (?, ?, ?, ?, ?, ?)";
        $stmt_products = mysqli_prepare($connect,$sql_products);
        mysqli_stmt_bind_param($stmt_products, "iiisii", $last_order_id, $product_id, $quantity, $product_title, $product_price, $total_price);
        mysqli_stmt_execute($stmt_products);
        mysqli_close($connect);
    }
}

//перенаправляємо на сторінку подяки, відміняємо сесію корзини
header('Location: ../typage.php');
unset($_SESSION['cart']);
    ?>
