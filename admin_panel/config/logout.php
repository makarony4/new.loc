<?php
session_start();
unset($_SESSION['employee']);
setcookie('login','', time() -86000, '/');
setcookie('role','', time() -86000, '/');
setcookie('name','', time() -86000, '/');
header('Location: ../login.php');