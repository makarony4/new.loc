<?php
require_once('../../connect.php');

$title = $_POST['title'];
$price  = $_POST['price'];
$description = $_POST['description'];
if (empty($title) && empty($price) && empty($description)) {
    header('Location: ../index.php');
}

$path = 'uploads/' . time() . $_FILES['photo']['name'];
move_uploaded_file($_FILES['photo']['tmp_name'], '../' . $path);


mysqli_query($connect, "INSERT INTO `products` (`id`, `title`, `description`, `price`, `photo`) VALUES (NULL, '$title', '$description', '$price', '$path')");

$path = 'uploads/' . time() . $_FILES['photo']['name'];
move_uploaded_file($_FILES['photo']['tmp_name'], '../' . $path);

header('Location: ../index.php');

//echo '<pre>';
//print_r($_POST);
//echo '</pre>';


