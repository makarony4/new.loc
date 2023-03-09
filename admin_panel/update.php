<?php
require_once('../connect.php');

$product_id = $_GET['id'];
$product = mysqli_query($connect,"SELECT * FROM `products` WHERE `id` = '$product_id'");
$product = mysqli_fetch_assoc($product);

?>




<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update</title>
</head>
<body>
<h3>UPDATE PRODUCT</h3>
<form action="config/update.php" method="post" enctype = "multipart/form-data">
    <p>Photo</p>
    <img src="<?=$product['photo']?>" width="100" height="100">
    <div>
    <input type="file" name="photo" value="<?=$product['photo']?>" accept=".jpg, .jpeg, .png" >
    </div>
    <input type="hidden", name="id", value="<?=$product_id?>">
    <p>Title</p>
    <input type="text" name="title" value="<?= $product['title'] ?>">
    <p>Price</p> <br>
    <input type="number" name="price" value="<?= $product['price'] ?>">
    <p>Description</p> <br>
    <textarea name="description"><?= $product['description'] ?></textarea><br><br>
    <button type="submit">Update product</button>
</form>
</body>
</html>