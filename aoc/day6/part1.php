<?php

$groups = explode(PHP_EOL.PHP_EOL, $file = file_get_contents('input.txt'));

$yesCounter = 0;

foreach ($groups as $group) {
    $groupAnswers = [];
    foreach (explode(PHP_EOL, $group) as $people) {
        foreach (str_split(trim($people)) as $answer) {
            $groupAnswers[$answer] = true;
        }
    }
    $yesCounter += count($groupAnswers);
}

echo $yesCounter;