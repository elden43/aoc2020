<?php

$input = explode(PHP_EOL,file_get_contents('input.txt'));
$refInput = $input;

$searchedSum = 2020;

foreach ($input as $inputValue) {
    foreach ($refInput as $refInputValue) {
        if ((int) $inputValue + (int) $refInputValue === $searchedSum) {
            echo (int) $inputValue * (int) $refInputValue;
            exit;
        }
    }
}