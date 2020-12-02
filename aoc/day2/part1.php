<?php
namespace AOC2020\Day2;

include "PasswordHelper.php";
include "Password.php";


class PasswordPart1 extends \Password {
    
    public function isValid(): bool {
        $charCount = substr_count($this->password, $this->letter);
        return $charCount >= $this->firstIntParameter && $charCount <= $this->secondIntParameter;   
    }

}

$input = file_get_contents('input.txt');

$validPasswordsCount = 0;
foreach (\PasswordHelper::resolvePasswords($input) as $password) {    
    if((new PasswordPart1($password[1], $password[2], $password[3], $password[4]))->isValid()) {
        $validPasswordsCount++;
    }    
}

echo $validPasswordsCount;

