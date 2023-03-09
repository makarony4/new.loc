<?php
require_once('../../connect.php');

$id = $_POST['id'];
$title = $_POST['title'];
$price = $_POST['price'];
$description = $_POST['description'];
$photo = $_FILES['photo']['name'];
$photo_tmp = $_FILES['photo']['tmp_name'];
if($photo_tmp != ""){
    $path = 'uploads/' . time() . $_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'], '../' . $path);

    $update = "UPDATE `products` SET `title` = '$title', `description` = '$description', `price` = '$price', photo='$path' WHERE `products`.`id` = '$id'";
}else{
    $update = "UPDATE `products` SET `title` = '$title', `description` = '$description', `price` = '$price' WHERE `products`.`id` = '$id'";

}

header('Location: ../index.php');


$run_update = mysqli_query($connect, $update);