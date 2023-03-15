<?php
session_start();
require_once ('../config/connect.php');
$full_name = $_POST['full_name'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

//якщо паролі співпадають , загружаю фото в потрібну папку
if($password === $confirm_password){
    if(!$path = 'uploads/' . time() . $_FILES['avatar']['name']) {
        move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path);

    }
    //хешую пасс
    $password = md5($password);
    $sql = "INSERT INTO users (full_name, login, email, password,avatar) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $full_name, $login, $email, $password, $path);
    mysqli_stmt_execute($stmt);
    mysqli_close($connect);
    header('Location: ../index.php');
    //повідомлення при успішній реєстрації
    $_SESSION['success'] = 'Реєстрація пройшла успішно';


}//повідомлення при неспівпаданні паролів
else{
    $_SESSION['message'] = 'Паролі не співпадають';
    header('Location: ../index.php');
}



?>
