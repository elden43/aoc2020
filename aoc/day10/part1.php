<?php

$inputFile = 'input.txt';

$input = file_get_contents(__DIR__ . '/input.txt');
$adapters = array_map('intval', explode(PHP_EOL, $input));

sort($adapters);

$jmps = [
    'jmp1' => 0,
    'jmp3' => 0,    
    ];

for ($i = 1; $i < count($adapters); $i++) {
    $diff = $adapters[$i] - $adapters[$i-1];
    if ($diff === 1) {
        $jmps['jmp1']++;        
    } elseif ($diff === 3) {
        $jmps['jmp3']++;
    }
}

echo ($jmps['jmp1']+1) * ($jmps['jmp3']+1);