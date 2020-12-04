<?php

include "Toboggan.php";
include "Helper.php";

$directions = [
    [1,1],
    [3,1],
    [5,1],
    [7,1],
    [1,2],
];

$result = 1;
foreach ($directions as $direction) {
    $result *= (new \AOC2020\Day3\Toboggan(\AOC2020\Day3\Helper::inputIntoArray('input.txt'),$direction[0],$direction[1]))->getHittedTrees();
}
echo $result;