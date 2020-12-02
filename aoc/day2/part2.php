<?php
namespace AOC2020\Day2;

include "PasswordHelper.php";
include "Password.php";


class PasswordPart2 extends \Password {
    
    public function isValid(): bool {
        $firstLetter = $this->password[$this->firstIntParameter-1] === $this->letter;
        $secondtLetter = $this->password[$this->secondIntParameter-1] === $this->letter;
        return $firstLetter xor  $secondtLetter;  
    }

}

$input = file_get_contents('input.txt');

$validPasswordsCount = 0;
foreach (\PasswordHelper::resolvePasswords($input) as $password) {    
    if((new PasswordPart2($password[1], $password[2], $password[3], $password[4]))->isValid()) {
        $validPasswordsCount++;
    }    
}

echo $validPasswordsCount;

