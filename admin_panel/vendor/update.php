<?php
session_start();

//require_once('../../config/connect.php');
require_once ('../token_generator.php');
require_once ('../../classes/db.php');

$up = new db();

$photo = $_FILES['photo']['name'];
$photo_tmp = $_FILES['photo']['tmp_name'];
//$id =$up->mysqli->real_escape_string($_POST['id']);
$id = $up->mysqli->real_escape_string($_POST['id']);
$title = $_POST['title'];
$price = $_POST['price'];
$description = $_POST['description'];
if($photo_tmp != ""){
    $path = 'uploads/' . time() . $_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'], '../' . $path);

//    $sql = "UPDATE `products` SET `title` = ?, `description` = ?, `price` = ?, photo= ? WHERE `products`.`id` = ?";
//    $stmt = mysqli_prepare($connect, $sql);
//    mysqli_stmt_bind_param($stmt, 'ssisi', $title, $description, $price, $path, $id);
//    mysqli_stmt_execute($stmt);
//mysqli_close($connect);
    var_dump($up->update('products', $id, ['title'=> $title, 'description'=>$description, 'price'=>$price, 'photo'=>$path]));

}else{
//    $sql = "UPDATE `products` SET `title` = ?, `description` = ?, `price` = ? WHERE `products`.`id` = ?";
//    $stmt = mysqli_prepare($connect, $sql);
//    mysqli_stmt_bind_param($stmt, 'ssii', $title, $description, $price, $id);
//    mysqli_stmt_execute($stmt);
//    mysqli_close($connect);
    var_dump($up->update('products', "$id", ['title'=> $title, 'description'=> $description, 'price'=> $price]));

}
//header('Location: ../index.php');
