<?php
//витягуємо параметри
function getParams(array $arr){
    $params = [];
    global $last_order_id;
    if($arr == $_POST){
        $param = array_values($arr);
        array_push($params, ...$param);
    }elseif ($arr == $_SESSION['cart']){
    foreach ($arr as $key => $values) {
        $param = array_values($values);
        $total_price = $values['price'] * $values['quantity'];
        array_push($params,$last_order_id, ...$param);
        $params[] = $total_price;
        }
    }
    return $params;
}


//беремо інфу з форми замовлення
//function deliveryInfo(array $arr){
//    $delivery_info = [];
//    $item = array_values($arr);
//    array_push($delivery_info, ...$item);
//    return $delivery_info;
//}


//ловимо знаки питання для бінду
function getMarks($count){
    $question_mark = "(" . str_repeat('?,' , count($count));
    if ($count == $_SESSION['cart']){
        $question_mark = "(" . str_repeat('?,' , count($_SESSION['cart'][0]) + 2);
    }
    $question_mark = substr($question_mark, 0, -1);
    $question_mark .= ")";
    if ($count == $_SESSION['cart']){
$question_mark .= ',';
$question_mark = str_repeat($question_mark, count($_SESSION['cart']));
$question_mark = substr($question_mark, 0 ,-1);
    }
    return $question_mark;
}


//ловимо типи даних для бінду

function getTypes($params){
    $type = '';
    foreach ($params as $param){
        if(is_string($param)){
        $type .= 's';
        }
        elseif(is_int($param)){
            $type .= 'i';
        }
    }
return $type;
}

//вставляємо в мускл
function insertOrder($table_name, $columns, $bind, $types, array $params){
    global $connect;
    $query = "INSERT INTO $table_name ($columns) VALUES $bind";
    $stmt_products = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt_products, $types ,...$params);
    mysqli_stmt_execute($stmt_products);
}