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
$i = 0;
$query_products = "INSERT INTO order_products (product_id, count, product_title, product_price, order_id, total_price) values ";
        if(!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $values) {
                $total_price = $values['price'] * $values['quantity'];
                $types[0] .= "sssssi";
                array_push($params, $values['id'], $values['quantity'], $values['title'], $values['price'], $last_order_id, $total_price);
                $i++;
                if ($i ==1){
                    $binded_params ="(" . str_repeat("?,",count($params));
                    $binded_params = substr($binded_params, 0 , -1);
                    $binded_params .= "),";
                }
            $query_products .= $binded_params;
        }
        }
        $query_products = substr($query_products, 0, -1);
        $stmt_products = mysqli_prepare($connect, $query_products);
        mysqli_stmt_bind_param($stmt_products, $types[0], ...$params);
        mysqli_stmt_execute($stmt_products);

mysqli_close($connect);
//перенаправляємо на сторінку подяки, відміняємо сесію корзини
header('Location: ../typage.php');
unset($_SESSION['cart']);
    ?>


