<?php
//беремо інфу з форми замовлення
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
    $order_types .= 'ssss';
}


//вставляємо в мускл
function insertOrder($table_name, $columns, $bind, $types, array $params){
    global $connect;
    $query = "INSERT INTO $table_name ($columns) VALUES $bind";
    $stmt_products = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt_products, "$types",...$params);
    mysqli_stmt_execute($stmt_products);}