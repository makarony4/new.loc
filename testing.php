<?php
require_once ('config/connect.php');

$sql = mysqli_query($connect, "SELECT * FROM products");

while($row = mysqli_fetch_assoc($sql)){
    print_r($row);
}