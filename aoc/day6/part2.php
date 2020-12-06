<?php

$groups = explode(PHP_EOL.PHP_EOL, $file = file_get_contents('input.txt'));

$allYesCounter = 0;

foreach ($groups as $group) {
    $groupAnswers = [];
    $firstInGroup = true;    
    foreach (explode(PHP_EOL, $group) as $people) {
        if ($firstInGroup) {
            $groupAnswers = str_split(trim($people));
            $firstInGroup = false;
        } else {
            $groupAnswers = array_intersect($groupAnswers, str_split(trim($people)));
        }        
    }
    $allYesCounter += count($groupAnswers);
}

echo $allYesCounter;