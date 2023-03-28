<?php
require_once ('../../connect.php');
session_start();

$login = $_POST['login'];


$result = mysqli_query($connect, "SELECT full_name,login, role FROM employee where login = '$login'");
$result = mysqli_fetch_assoc($result);
$_SESSION['employee'] = [
    'login' => $result['login'],
    'full_name' => $result['full_name'],
    'role' => $result['role']
];

$password = $_POST['password'];

if($login == $result['login']){
    if($result['role'] == 'admin'){
        header('Location: ../index.php');
    }
    elseif($result['role'] == 'manager'){
        header('Location: ../orders.php');
    }
}else {
    header('Location: ../login.php');
    $_SESSION['faillogin'] == 'Невірний логін або пароль';
}




