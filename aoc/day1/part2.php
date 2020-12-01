<?php

$input1 = $input2 = $input3 = explode(PHP_EOL,file_get_contents('input.txt'));

$searchedSum = 2020;

foreach ($input1 as $input1Value) {
    foreach ($input2 as $input2Value) {
        foreach ($input3 as $input3Value) {
            if ((int) $input1Value + (int) $input2Value + (int) $input3Value === $searchedSum) {
                echo (int) $input1Value * (int) $input2Value * (int) $input3Value;
                exit;
            }
        }
    }
}