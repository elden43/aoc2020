<?php

namespace AOC2020\Day8;

include "Command.php";
include "Programme.php";

$baseSequence = [];
$input = file_get_contents('input.txt');
preg_match_all('/^(.*) ([+-][[:digit:]]*)$/m', $input, $matches, PREG_SET_ORDER);
foreach ($matches as $match) {
    $baseSequence[] = new Command($match[1], (int) $match[2]); 
}


function alternateSequence(array &$sequence, string $operation, int $position): void {
    $sequence[$position]->changeCommand($operation);
}

function findAllPositions(string $operation, array $sequence): array {    
    $commandList = [];
    /** @var \AOC2020\Day8\Command $command */
    foreach ($sequence as $key => $command) {
        
        if ($command->operation === $operation) {        
            $commandList[] = $key;
        }
    }    
    
    return $commandList;
}

function copySequence(array $sequence): array {
    $newSequence = [];
    foreach ($sequence as $item) {
        $newSequence[] = clone $item;
    }
    
    return $newSequence;    
}


$operationsReplace = ['jmp' => 'nop', 'nop' => 'jmp'];

foreach($operationsReplace as $from => $to) {
    $commandList = findAllPositions($from, $baseSequence);
    foreach ($commandList as $newPosition) {    
        $sequence = copySequence($baseSequence);    
        alternateSequence($sequence, $to, $newPosition);
        
        $programme = new Programme($sequence);    
        $programme->run();
        
        if ($programme->successfullyFinished) {
            $programme->printResult();
        }        
    }
}