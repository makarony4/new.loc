<?php
session_start();

require_once ('../../vendor/autoload.php');
$delete_product = new \MyApp\db();
$id = $delete_product->mysqli->real_escape_string($_POST['id']);
$delete_product->update('products', $id, ['status'=>'not_active']);
header('Location: ../index.php');
