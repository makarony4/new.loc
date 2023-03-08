<?php
session_start();
require_once ('../config/connect.php');
$full_name = $_POST['full_name'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if($password === $confirm_password){
    if(!$path = 'uploads/' . time() . $_FILES['avatar']['name']) {
        move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path);

    }
    $password = md5($password);
    mysqli_query($connect, "INSERT INTO users (full_name, login, email, password,avatar) VALUES ('$full_name', '$login', '$email', '$password', '$path')");
    header('Location: ../index.php');
    $_SESSION['success'] = 'Реєстрація пройшла успішно';


}
else{
    $_SESSION['message'] = 'Паролі не співпадають';
    header('Location: ../index.php');
}



?>
