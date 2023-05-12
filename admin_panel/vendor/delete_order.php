<?php
require_once ('../../vendor/autoload.php');
$delete_order = new \MyApp\db();
$id = $delete_order->mysqli->real_escape_string($_GET['id']);
$delete_order->delete('orders', $id);
$sql  = "DELETE FROM orders WHERE `orders`.`id` = ?";
header('Location: ../orders.php');