<?php

namespace AOC2020\Day4;


class Helper
{
    public static function inputToArray($inputFile): array {
        $file = file_get_contents($inputFile);
        return  explode(PHP_EOL.PHP_EOL, $file);
    }
}