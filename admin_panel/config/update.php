<?php
require_once('../../connect.php');

$id = $_POST['id'];
$title = $_POST['title'];
$price = $_POST['price'];
$description = $_POST['description'];

if($path = 'uploads/' . time() . $_FILES['photo']['name'] !== "") {
    move_uploaded_file($_FILES['photo']['tmp_name'], '../' . $path);
}
$update = mysqli_query($connect, "UPDATE `products` SET `title` = '$title', `description` = '$description', `price` = '$price', photo='$path' WHERE `products`.`id` = '$id'");

header('Location: ../index.php');
