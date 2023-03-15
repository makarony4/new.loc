<?php
session_start();
require_once ('../config/connect.php');

$login = $_POST['login'];
$password = md5($_POST['password']);
$sql = "SELECT * FROM users WHERE login = ? AND password = ?";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "ss", $login, $password);
mysqli_stmt_execute($stmt);
$check_user = mysqli_stmt_get_result($stmt);

mysqli_close($connect);
if(mysqli_num_rows($check_user) > 0){
    $user = mysqli_fetch_assoc($check_user);
    $_SESSION['user'] = [
        'id' => $user['id'],
        'full_name' => $user['full_name'],
        'avatar' => $user['avatar'],
        'email' => $user['email']
    ];
    header('Location: ../profile.php');
}else{
    $_SESSION['loginfail'] = 'Невірно введений логін аьо пароль';
    header('Location: ../index.php');
}