<?php

namespace AOC2020\Day4;

include 'Helper.php';
include 'Passport.php';

$inputs = Helper::inputToArray('input.txt');

$validPassports = 0;

foreach ($inputs as $input) {
    if ((new Passport($input))->isValid()) {
        $validPassports++;
    }
}

echo $validPassports;