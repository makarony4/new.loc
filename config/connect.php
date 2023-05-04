<?php
//підключення до БД
require_once (__DIR__ . '/../classes/DbConnect.php');
$connect = mysqli_connect('localhost', 'root', 'root', 'crud');



if (mysqli_connect_errno()){
    die ('No connection to database');
}

?>


