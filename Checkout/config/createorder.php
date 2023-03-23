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
$products_column = "order_id, " . $columns . " total_price";



insertOrder('order_products', $products_column, $_SESSION['cart']);


//перенаправляємо на сторінку подяки, відміняємо сесію корзини
//header('Location: ../typage.php');
//unset($_SESSION['cart']);
    ?>


