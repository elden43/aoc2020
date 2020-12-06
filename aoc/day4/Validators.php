<?php

namespace AOC2020\Day4;


class Validators
{
    public static function validateByr($input): bool {        
        $regex = '/^[[:digit:]]{4}$/';
        if (preg_match($regex, $input, $matches) === 0) {
            return false;
        }
        if ((int) $input < 1920 || (int) $input > 2002) {
            return false;
        }        
        return true;   
    }
    
    public static function validateIyr($input): bool {
        $regex = '/^[[:digit:]]{4}$/';
        if (preg_match($regex, $input, $matches) === 0) {
            return false;
        }
        if ((int) $input < 2010 || (int) $input > 2020) {
            return false;
        }
        return true;   
    }

    public static function validateEyr($input): bool {
        $regex = '/^[[:digit:]]{4}$/';
        if (preg_match($regex, $input, $matches) === 0) {
            return false;
        }
        if ((int) $input < 2020 || (int) $input > 2030) {
            return false;
        }
        return true;
    }

    public static function validateHgt($input): bool {
        $regex = '/^[[:digit:]]{2,3}(?:cm|in)$/';
        if (preg_match($regex, $input, $matches) === 0) {
            return false;
        }
        if (str_contains($input, 'cm') && ((int) substr($input, 0, 3) < 150 || (int) substr($input, 0, 3) > 193)) {
            return false;
        }
        if (str_contains($input, 'in') && ((int) substr($input, 0, 2) < 59 || (int) substr($input, 0, 3) > 76)) {
            return false;
        }
        return true;
    }

    public static function validateHcl($input): bool {
        $regex = '/^#[0-9a-f]{6}$/';
        if (preg_match($regex, $input, $matches) === 0) {
            return false;
        }        
        return true;
    }

    public static function validateEcl($input): bool {
        $regex = '/^amb|blu|brn|gry|grn|hzl|oth$/';
        if (preg_match($regex, $input, $matches) === 0) {
            return false;
        }
        return true;
    }

    public static function validatePid($input): bool {
        $regex = '/^[[:digit:]]{9}$/';
        if (preg_match($regex, $input, $matches) === 0) {
            return false;
        }
        return true;
    }    
}