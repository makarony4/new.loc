<?php
function insert($table_name, $params, $last_id = ''){
    $sql = "INSERT INTO $table_name VALUES $params";

    $query_products = substr($query_products, 0, -1);
    $stmt_products = mysqli_prepare($connect, $query_products);
    mysqli_stmt_bind_param($stmt_products, $types[0], ...$params);
    mysqli_stmt_execute($stmt_products);

}