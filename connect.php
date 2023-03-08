<?php
$connect = mysqli_connect('localhost', 'root', '', 'crud');



if (!$connect){
    die ('No connection to database');
}
