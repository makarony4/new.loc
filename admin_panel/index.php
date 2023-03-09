<?php
error_reporting(-1);
require_once('../connect.php');

//create product

$products = mysqli_query($connect,"SELECT * FROM `products`");
$products = mysqli_fetch_all($products);


//$path = 'uploads/' . time() . $_FILES['photo']['name'];
//move_uploaded_file($_FILES['photo']['tmp_name'], '../' . $path);


//mysqli_query($connect, "INSERT INTO `products` (`id`, `title`, `description`, `price`) VALUES (NULL, '$title', '$description', '$price');");
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<style>
    th,td{
        padding: 10px;
    }
    th{
        background:#606060;
    }

    td{
        background: bisque;
    }
</style>
<body>
<h1><a href="orders.php" class="link-primary">Orders</a></h1>
<a href = "../index.php">Products page</a>
<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Price</th>
        <th>Description</th>
        <th>Photo</th>

    </tr>

    <?php

    foreach ($products as $product) {
        ?>
    <tr>
        <td><?=$product[0]?></td>
        <td><?=$product[1]?></td>
        <td><?=$product[2]?></td>
        <td><?=$product[3]?></td>
        <td><img src="<?=$product[4]?>" width="100" height="100"></td>
        <td><a href="update.php?id=<?=$product[0]?>">Update</a></td>
        <td><a href="delete.php?id=<?=$product[0]?>">Delete</a> </td>
    </tr>
    <?php
}
    ?>
</table><br><br>
<form action="config/create.php" method="post" enctype = "multipart/form-data">
    <h3>Create new product</h3>
    <p>Photo</p>
    <input type="file" name="photo">
    <p>Title</p>
    <input type="text" name="title">
    <p>Price</p> <br>
    <input type="number" name="price">
    <p>Description</p> <br>
    <textarea name="description"></textarea> <br>
    <button type="submit">Create new product</button>
</form>
</table><br><br>
</body>
</html>