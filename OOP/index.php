<?php
require_once ('classes/Car.php');

function debug($data){
    echo '<pre>' . print_r($data, 1) . '</pre>';
}

$car1 = new Car();
//debug($car1);

$car1 -> color = 'Black';
$car1 -> brand = 'Volvo';
$car1 -> year = 2018;
//debug($car1);

$car2 = new Car();
$car2 -> color = 'White';
$car2 -> brand = 'bmw';
$car2 -> speed = 200;
$car2 -> year = 2016;


echo $car2->getCarInfo();

