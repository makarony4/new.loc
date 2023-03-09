<?php

require_once('../connect.php');

$id = $_GET['id'];

mysqli_query($connect, "DELETE FROM products WHERE `products`.`id` = '$id'");
mysqli_query($connect, "DELETE FROM orders WHERE `orders`.`id` = '$id'");

header('Location: index.php');
