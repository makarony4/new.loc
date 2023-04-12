<?php
class Car{
 public $color;
 public $wheels = 4;
 public $speed = 180;
 var $brand;
 public function getCarInfo(){
     return "<h3>About my car</h3>
Brand: {$this -> brand}<br>
Color: {$this ->color} <br>
Q-ty wheels: {$this->wheels}<br>
Year: {$this->year}<br>
Speed: {$this ->speed}<br>
";
 }
}