<?php
session_start();
require_once ('../../connect.php');
require_once ('../../funcs/funcs.php');
$last_order_id= (mysqli_insert_id($connect));

$columns = '';
foreach ($_POST as $key => $value){
$columns .= $key . ",";
}
$columns = substr($columns, 0 , -1);



insertOrder('orders',$columns,$_POST);
$last_order_id= (mysqli_insert_id($connect));

$columns = '';
foreach($_SESSION['cart'] as $keys => $values){
    foreach ($values as $key  => $value){
        $columns .= $key . ",";
    }
    break;
}
$products_column = $columns . " total_price, order_id";


$product_params = [];
foreach ($_SESSION['cart'] as $key => $value){
    $value['total_price'] = $value['price'] * $value['quantity'];
    $value['order_id'] = $last_order_id;
    foreach ($value as $key => $value) {
        $product_params[] = $value;
    }
}
//var_dump(getParams($_POST));
insertOrder('order_products', $products_column, $product_params);


//перенаправляємо на сторінку подяки, відміняємо сесію корзини
header('Location: ../typage.php');
unset($_SESSION['cart']);
    ?>


