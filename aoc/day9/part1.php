<?php
$inputFile = "input.txt";
$numbers = explode(PHP_EOL,file_get_contents($inputFile));

$preambleCount = 25;

$preamble = array_slice($numbers, 0, $preambleCount);
array_splice($numbers, 0, $preambleCount);

foreach ($numbers as $number) {
    if (!preambleCheck($number, $preamble)) {
        echo $number;
        exit;
    } else {        
        array_splice($preamble, 0, 1);
        array_push($preamble, $number);        
    }
}

function preambleCheck(int $numberToCheck, array $preamble): bool {
    for ($i = 0; $i < count($preamble); $i++) {
        for ($j = $i + 1; $j < count($preamble); $j++) {
            if ($preamble[$i] + $preamble[$j] === $numberToCheck) {
                return true;
            }
        }
    }
    
    return false;
}