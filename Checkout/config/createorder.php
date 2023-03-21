<?php
session_start();
require_once ('../../connect.php');


$delivery_info = [];
$order_marks = '';
$order_types = '';
function deliveryInfo(array $arr){
    global $delivery_info, $order_marks,$order_types;
        $item = array_values($arr);
        array_push($delivery_info, ...$item);
        $order_marks .= "(" . str_repeat("?,", count($arr));
        $order_marks = substr($order_marks, 0, -1);
        $order_marks .= ")";
        $order_types .= 'siss';
}
function insertOrder($table_name, $columns, $bind, $types, array $params){
    global $connect;
    $query = "INSERT INTO $table_name ($columns) VALUES $bind";
    $stmt_products = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt_products, "$types",...$params);
    mysqli_stmt_execute($stmt_products);
}
deliveryInfo($_POST);
var_dump(insertOrder('orders', 'full_name, city, address, number', $order_marks, $order_types, $delivery_info));

$last_order_id= (mysqli_insert_id($connect));
$params = [];
$types = '';
$i = 0;
$question_marks = '';
if(!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $values) {
                $param = array_values($values);
                array_push($params, ...$param);
                $total_price = $values['price'] * $values['quantity'];
                $types .= "ssssii";
                array_push($params, $last_order_id, $total_price);
                $i++;
                if ($i ==1){
                    $binded_params ="(" . str_repeat("?,",count($params));
                    $binded_params = substr($binded_params, 0 , -1);
                    $binded_params .= "),";
                }
            $question_marks .= $binded_params;
        }
        }
        $question_marks = substr($question_marks, 0, -1);






$columns = "product_id, product_title, product_price, count, order_id, total_price";
insertOrder('order_products',$columns , $question_marks, $types, $params);
//перенаправляємо на сторінку подяки, відміняємо сесію корзини
//header('Location: ../typage.php');
//unset($_SESSION['cart']);
    ?>


