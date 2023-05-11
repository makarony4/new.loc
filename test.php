<?php
$arr = ['title'=> '124', 'description'=> '124', 'price'=> '111111', 'photo'=>'124124'];

$keys = [];
$values = [];

foreach ($arr as $key=>$value) {
    $keys[] = $key .= '= ?';
    $values[] = $value;
}

$keys = implode(', ', $keys);
$values = implode(',', $values);

var_dump($keys);
echo "<br>";
var_dump($values);