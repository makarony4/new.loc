<?php

$_SESSION['token_expire'] = time() + 3600;

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    die('Another request method');
}



if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!isset($_POST['token']) || ($_POST['token'] !== $_SESSION['token'])){
        die('Invalid csrf token!');
    }
}

$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
