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

$params = [];
$types = [''];
$query_products = "INSERT INTO order_products (product_id, count, product_title, product_price, order_id, total_price) values ";
        if(!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $values) {
            $query_products .= "(?,?,?,?,?,?),";
            $order_id = $last_order_id;
            $product_id = $values['id'];
            $product_price = $values['price'];
            $product_title = $values['title'];
            $quantity = $values['quantity'];
            $total_price = $quantity * $product_price;
            $types[0] .= 'ssssii';

            array_push($params, $product_id, $quantity, $product_title, $product_price, $order_id, $total_price);
//            $values = array_values($values);
//            $values[] = $last_order_id;
//            $values[] = $values[2] * $values[3];
//            $items[] = $values;


        }
        }
        $query_products = substr($query_products, 0, -1);
        $stmt_products = mysqli_prepare($connect, $query_products);
        mysqli_stmt_bind_param($stmt_products, "$types[0]", ...$params);
        mysqli_stmt_execute($stmt_products);



mysqli_close($connect);
//перенаправляємо на сторінку подяки, відміняємо сесію корзини
//header('Location: ../typage.php');
//unset($_SESSION['cart']);
    ?>


