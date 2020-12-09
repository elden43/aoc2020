<?php
$inputFile = "input.txt";
$numbers = explode(PHP_EOL,file_get_contents($inputFile));
$numberToCheck = 217430975;

function sumCheck(int $numberToCheck, array $allNumbers): array {
    for ($i = 0; $i < count($allNumbers); $i++) {
        $sum = $allNumbers[$i];        
        for ($j = $i + 1; $j < count($allNumbers); $j++) {            
            $sum += $allNumbers[$j];  
            if ($sum === $numberToCheck) {
                return [$i, $j];                
            } elseif ($sum > $numberToCheck) {                
                break;
            }
        }
    }    
    
    return [];
}

$positions = sumCheck($numberToCheck, $numbers);
$modifiedArray = array_slice($numbers, $positions[0], $positions[1] - $positions[0] +1 );
echo min($modifiedArray) + max($modifiedArray);