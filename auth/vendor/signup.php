<?php
session_start();
//require_once ('../../config/connect.php');

require_once('../../classes/db.php');
$a = new db();

$full_name = $_POST['full_name'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$confirm_password = md5($_POST['confirm_password']);
$check = $a->select('users', 'email,login');
$result = $a->sql;
$check = mysqli_fetch_all($result);


//якщо паролі співпадають , загружаю фото в потрібну папку
if ($password === $confirm_password) {
    if ($path = 'uploads/' . time() . $_FILES['avatar']['name']) {
        move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path);

    }

    foreach ($check as $item) {
        if ($_POST['login'] == $item[1]) {
            $_SESSION['duplicate'] = 'Користувач з такимм логіном вже існує';
            header('Location: ../register.php');
        }
        if ($_POST['email'] == $item[0]) {
            $_SESSION['duplicate'] = 'Користувач з такою електронною поштою вже існує';
            header('Location: ../register.php');
        }
    }

    if (!isset($_SESSION['duplicate'])) {
        $_SESSION['success'] = 'Реєстрація пройшла успішно';
        $a->insert('users', ['full_name'=>$full_name, 'email'=>$email, 'avatar'=>$path, 'login'=>$login, 'password'=>$password]);
        header('Location: ../index.php');

    }


}//повідомлення при неспівпаданні паролів
else {
    $_SESSION['message'] = 'Паролі не співпадають';
    header('Location: ../index.php');
}


?>
