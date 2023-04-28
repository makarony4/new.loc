<?php
session_start();
require_once('../../config/connect.php');
require_once ('../token_generator.php');


$id = $_POST['id'];
$sql  = "UPDATE products SET status = 'not_active' WHERE `products`.`id` = ?";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
mysqli_close($connect);
header('Location: ../index.php');
