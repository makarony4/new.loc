<?php
require_once ('../../connect.php');
session_start();

$login = $_POST['login'];
$password = $_POST['password'];



$result = mysqli_query($connect, "SELECT full_name,login, password, role FROM employee where login = '$login'");
$result = mysqli_fetch_assoc($result);
$_SESSION['employee'] = [
    'login' => $result['login'],
    'full_name' => $result['full_name'],
    'role' => $result['role']
];


if($login == $result['login'] and $password == md5($result['password'])) {
    if (isset($_POST['rememberme']) and $_POST['rememberme'] == 'on') {
        setcookie('login', $result['login'], time() + 86000, '/');
        setcookie('role', $result['role'], time() + 86000, '/');
    }
}
setcookie('login', $result['login'], time() + 3600, '/');
setcookie('role', $result['role'], time() + 3600, '/');

    if($result['role'] == 'admin'){
        header('Location: ../index.php');
    }
    elseif($result['role'] == 'manager'){
        header('Location: ../orders.php');
}else {
    header('Location: ../login.php');
    $_SESSION['faillogin'] = 'Невірний логін або пароль';
}





