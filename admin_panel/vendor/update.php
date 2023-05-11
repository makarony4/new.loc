<?php
session_start();

require_once ('../../vendor/autoload.php');

$up = new \MyApp\db();
$photo = $_FILES['photo']['name'];
$photo_tmp = $_FILES['photo']['tmp_name'];
$id = $up->mysqli->real_escape_string($_POST['id']);
$title = $_POST['title'];
$price = $_POST['price'];
$description = $_POST['description'];
if ($photo_tmp != "") {
    $path = 'uploads/' . time() . $_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'], '../' . $path);


    $up->update('products', $id, ['title' => $title, 'description' => $description, 'price' => $price, 'photo' => $path]);

} else {

    $up->update('products', "$id", ['title' => $title, 'description' => $description, 'price' => $price]);

}
header('Location: ../index.php');
