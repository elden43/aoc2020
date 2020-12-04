<?php

include "Toboggan.php";
include "Helper.php";

echo (new \AOC2020\Day3\Toboggan(\AOC2020\Day3\Helper::inputIntoArray('input.txt'),3,1))->getHittedTrees();
