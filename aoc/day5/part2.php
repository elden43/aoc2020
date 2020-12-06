<?php

foreach (explode(PHP_EOL,file_get_contents('input.txt')) as $input) {
    $rows = substr($input, 0, 7);
    $columns = substr($input, -3, 3);

    $rows = str_replace('B', '0', $rows);
    $rows = str_replace('F', '1', $rows);
    $columns = str_replace('L', '0', $columns);
    $columns = str_replace('R', '1', $columns);
    
    $rowDec = 127 - bindec($rows);
    $columDec = bindec($columns);

    $ids[] = (($rowDec*8) + $columDec);
} 

$refArray = range(min($ids), max($ids));
$missingId = array_diff($refArray, $ids);
var_dump($missingId);