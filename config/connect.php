<?php
//підключення до БД
$connect = mysqli_connect('localhost', 'root', 'root', 'crud');



if (mysqli_connect_errno()){
    die ('No connection to database');
}

?>


