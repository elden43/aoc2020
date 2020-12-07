<?php

function normalizeRulesBody($row): string {
    return trim(str_replace(['bags', 'bag', '.'], ['', '', ''], $row));
}

function getInRowRules(array $rules): array {
    $inRowRules = [];
    foreach ($rules as $rule) {
        preg_match('/^ ?([[:digit:]]*) (.*)$/',$rule, $matches);
        $inRowRules[trim($matches[2])] = $matches[1];
    }

    return  $inRowRules;
}

function countInTree(string $start, array $tree, int &$hits, int $rootMultiplier) {
    if(key_exists($start, $tree)) {
        foreach ($tree[$start] as $key => $value) {
            $hits += $rootMultiplier*$value;
            countInTree($key, $tree,  $hits, $rootMultiplier*$value);
        }
    }
}

//input
$inputFile = 'input.txt';
$rows = explode(PHP_EOL,file_get_contents($inputFile));

//rules population
$rules = [];
foreach ($rows as $row) {
    $matches =[];
    if (str_contains($row, 'contain no other bags')) {
        continue;
    }
    if (preg_match('/^(.*) bags contain (.*).$/mU', $row, $matches) === 1) {
        $rules[$matches[1]] = getInRowRules(explode(',', normalizeRulesBody($matches[2])));
    }
}

//search
$search = 'shiny gold';
$hits = 0;
countInTree($search, $rules, $hits, 1);       

echo $hits;
