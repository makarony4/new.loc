<?php
require_once('connect.php');

$title = $_POST['title'];
$price = $_POST['price'];

if(!mysqli_connect_errno()) {
mysqli_autocommit($connect,false);
$sql = "INSERT INTO orders_test (title, `price`) VALUES (?, ?)";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, 'ss', $title,$price);
mysqli_stmt_execute($stmt);
}
    if(!mysqli_commit($connect)){
        echo "Commit transaction failed";
        mysqli_rollback($connect);
    }



mysqli_close($connect);

?>
