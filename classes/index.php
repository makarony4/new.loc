<?php
require_once ('DbConnect.php');
require_once ('Product.php');
require_once ('DbFuncs.php');

$product = new DbFuncs();
$product->showAllProducts('*');



