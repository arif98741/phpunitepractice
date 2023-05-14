<?php
require 'vendor/autoload.php';

use App\Calculator;

$cal = new Calculator();
echo $cal->addition(1,2);

echo $cal->subtraction(1,2);