<?php
session_start();
require_once ('../../connect.php');
require_once ('../../funcs/funcs.php');

deliveryInfo($_POST);
insertOrder('orders', 'full_name, city, address, number', $order_marks, $order_types, $delivery_info);

var_dump(array_values($_POST));
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


