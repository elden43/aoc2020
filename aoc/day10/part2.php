<?php

$inputFile = 'input.txt';

$input = file_get_contents(__DIR__ . '/'. $inputFile);
$adapters = array_map('intval', explode(PHP_EOL, $input));


function getCombinations(int $partLength): int {
    switch ($partLength) {
        case 1:         
        case 2:
            return 1;
        case 3: 
            return 2;
        case 4:
            return 4;
        case 5:
            return 7;
    }
    
    return 0;
}

$adapters[] = 0;
$adapters[] = max($adapters)+3;
sort($adapters);

$subPartStarts = 0;
$subParts = [];
for ($i = 1; $i < count($adapters); $i++) {
    if ($adapters[$i] - $adapters[$i - 1] === 3) {
        $subParts[] = array_slice($adapters, $subPartStarts, $i - $subPartStarts);
        $subPartStarts = $i;
    }
}

$totalCombinations = 1;
foreach ($subParts as $subPart) {
    $totalCombinations *= getCombinations(count($subPart));
}

echo $totalCombinations;

