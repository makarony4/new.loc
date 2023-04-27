<?php
$token = bin2hex(random_bytes(32));
$_SESSION['token'] = $token;

$_SESSION['token_expire'] = time() + 3600;
if (!$token || !$_SESSION['token']){
    exit('Token is not SET!');
}

if (isset($_SESSION['token']) && $_SESSION['token'] == $token){
    if (time() >= $_SESSION['token_expire']){
        exit('Token expired');
    }
    $errors = 0;
    unset($_SESSION['token']);
    unset($_SESSION['token_expire']);
}else{
    exit('Invalid token');
}
