<?php
require_once ('../../vendor/autoload.php');

$create = new \MyApp\db();

$title = $_POST['title'];
$price = $_POST['price'] + 0;
$description = $_POST['description'];
$path = 'uploads/' . time() . $_FILES['photo']['name'];

$create->insert('products',['title' => $title, 'price'=>$price, 'description'=>$description, 'photo'=>$path, 'status'=>'active']);


if($create == true) {
    move_uploaded_file($_FILES['photo']['tmp_name'], '../' . $path);
    header('Location: ../index.php');
}else{
    echo "<h3>Item not created!Connecting error.</h3>";
}


