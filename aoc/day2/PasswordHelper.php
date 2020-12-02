<?php

class PasswordHelper {

    public static function resolvePasswords(string $passwordLine) {
        preg_match_all('/^([\d]+)-([\d]+) ([a-z]{1}). (.*)$/m', $passwordLine, $matches, PREG_SET_ORDER);
        return $matches;
    }
}