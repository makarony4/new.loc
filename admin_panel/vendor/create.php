<?php
//require_once('../../config/connect.php');

require_once ('../../classes/db.php');

$title = $_POST['title'];
$price = $_POST['price'] + 0;
$description = $_POST['description'];
$path = 'uploads/' . time() . $_FILES['photo']['name'];

$a = new db();
$a->insert('products',['title' => $title, 'price'=>$price, 'description'=>$description, 'photo'=>$path, 'status'=>'active']);


if($a == true) {
    move_uploaded_file($_FILES['photo']['tmp_name'], '../' . $path);
    header('Location: ../index.php');

}


