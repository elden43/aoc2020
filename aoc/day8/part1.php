<?php

namespace AOC2020\Day8;

include_once "Programme.php";

$input = file_get_contents('input.txt');
preg_match_all('/^(.*) ([+-][[:digit:]]*)$/m', $input, $matches, PREG_SET_ORDER);
foreach ($matches as $match) {
    $sequence[] = new Command($match[1], (int) $match[2]); 
}

$programme = new Programme($sequence);
$programme->run();
$programme->printResult();
