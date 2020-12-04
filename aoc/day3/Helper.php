<?php

namespace AOC2020\Day3;


class Helper
{
    static function inputIntoArray($inputFile) {
        $input = [];
        $rows = explode(PHP_EOL,file_get_contents($inputFile));
        foreach ($rows as $row) {
            $input[] = str_split(trim($row));
        }

        return $input;
    }
}