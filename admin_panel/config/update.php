<?php
require_once('../../connect.php');
$photo = $_FILES['photo']['name'];
$photo_tmp = $_FILES['photo']['tmp_name'];
$id = $_POST['id'];
$title = $_POST['title'];
$price = $_POST['price'];
$description = $_POST['description'];
if($photo_tmp != ""){
    $path = 'uploads/' . time() . $_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'], '../' . $path);

    $sql = "UPDATE `products` SET `title` = ?, `description` = ?, `price` = ?, photo= ? WHERE `products`.`id` = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, 'ssisi', $title, $description, $price, $path);
    mysqli_stmt_execute($stmt);
mysqli_close($connect);

}else{
    $sql = "UPDATE `products` SET `title` = '$title', `description` = '$description', `price` = '$price' WHERE `products`.`id` = '$id'";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_execute($stmt);
    mysqli_close($connect);

}
//header('Location: ../index.php');
