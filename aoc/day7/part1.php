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

function searchInTree(string $start, array $tree, string $searchingFor, array &$hits, $root) {
    if(key_exists($start, $tree)) {
        foreach ($tree[$start] as $key => $value) {
            if ($key === $searchingFor) {
                $hits[$root] = 1;
            }
            searchInTree($key, $tree, $searchingFor, $hits, $root);
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
$hits = [];
foreach ($rules as $key => $value) {    
    searchInTree($key, $rules, $search, $hits, $key);       
}

echo count($hits);
