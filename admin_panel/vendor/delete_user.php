<?php
require_once ('../../vendor/autoload.php');
$delete_user = new \MyApp\db();
$id = $delete_user->mysqli->real_escape_string($_GET['id']);
$delete_user->delete('users', $id);
header('Location: ../users.php');
