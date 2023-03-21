<?php
session_start();
require_once ('../../connect.php');

function saveProducts($params, $types){
return $params;
}

function insertOrder($table_name, $columns, $bind, $types, $params){
    global $connect;
    $query = "INSERT INTO $table_name ($columns) VALUES $bind";
    $stmt_products = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt_products, "$types",...$params);
    mysqli_stmt_execute($stmt_products);
}
if(!$_POST){
    foreach ($_POST as $item) {
        echo $item;
    }
}

//$full_name = $_POST['full_name'];
//$city = $_POST['city'];
//$address = $_POST['address'];
//$number = $_POST['number'];
//$sql = "INSERT INTO orders (full_name, `number` , city, address) VALUES (?, ?, ?, ?)";
//$stmt = mysqli_prepare($connect, $sql);
//mysqli_stmt_bind_param($stmt, "siss", $full_name, $number, $city, $address);
//mysqli_stmt_execute($stmt);
//$last_order_id= (mysqli_insert_id($connect));




$params = [];
$types = '';
$i = 0;
$question_marks = '';
//$query_products = "INSERT INTO order_products (product_id, product_title, product_price, count, order_id, total_price) values ";
        if(!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $values) {
                $param = array_values($values);
                array_push($params, ...$param);
                $total_price = $values['price'] * $values['quantity'];
                $types .= "ssssii";
//                array_push($params, $last_order_id, $total_price);
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
//        insertOrder('order_products',$columns , $question_marks, $types, $params);
//перенаправляємо на сторінку подяки, відміняємо сесію корзини
//header('Location: ../typage.php');
//unset($_SESSION['cart']);
    ?>


