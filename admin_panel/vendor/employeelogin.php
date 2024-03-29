<?php
require_once('../../config/connect.php');
session_start();

if (!isset($_POST['token']) || !isset($_SESSION['csrf_token'])) {
    exit('Token is not set!');
}
if ($_POST['token'] == $_SESSION['csrf_token']) {
    echo "Validate";
    unset($_SESSION['csrf_token']);
} else {
    exit('Invalid token');
}


$login = $_POST['login'];
$password = md5($_POST['password']);


$result = mysqli_query($connect, "SELECT full_name,login, password, role FROM employee where login = '$login'");
$result = mysqli_fetch_assoc($result);

$token = bin2hex(openssl_random_pseudo_bytes(16));


$_SESSION['employee'] = [
    'login' => $result['login'],
    'full_name' => $result['full_name'],
    'role' => $result['role']
];


if ($login == $result['login'] and $password == $result['password']) {
    if (isset($_POST['rememberme']) and $_POST['rememberme'] == 'on') {
        setcookie('login', $result['login'], time() + 60 * 60 * 24 * 30, '/');
        setcookie('role', $result['role'], time() + 60 * 60 * 24 * 30, '/');
        setcookie('name', $result['full_name'], time() + 60 * 60 * 24 * 30, '/');
        setcookie('token', $token, time() + 60 * 60 * 24 * 30, '/');
        mysqli_query($connect, "UPDATE employee SET token = '$token' where login = '$login'");
    }
    setcookie('login', $result['login'], time() + 86000, '/');
    setcookie('role', $result['role'], time() + 86000, '/');
    setcookie('name', $result['full_name'], time() + 86000, '/');
    setcookie('token', $token, time() + 86000, '/');
    mysqli_query($connect, "UPDATE employee SET token = '$token' where login = '$login'");
}


if ($result['role'] == 'admin') {
    header('Location: ../index.php');
} elseif ($result['role'] == 'manager') {
    header('Location: ../orders.php');
} else {
    header('Location: ../login.php');
    $_SESSION['faillogin'] = 'Невірний логін або пароль';
}

if ($token != $_COOKIE['token']) {
    $_SESSION['token_missing'] = 'Відмовлено в доступі!';
    header('Location: ../index.php');
}




