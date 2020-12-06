<?php

namespace AOC2020\Day4;

include 'Validators.php';

class Passport
{
    private string|null $byr;
    
    private string|null $iyr;
    
    private string|null $eyr;
    
    private string|null $hgt;
    
    private string|null $hcl;
    
    private string|null $ecl;
    
    private string|null $pid;
    
    private string|null $cid;
    
    private const PASSWORD_PARAMETER_ENFORCEMENT_LEVEL_REQUIRED = 'required';
    private const PASSWORD_PARAMETER_ENFORCEMENT_LEVEL_OPTIONAL = 'optional';
    
    private const PASSWORD_PARAMETERS = [
        'byr' => self::PASSWORD_PARAMETER_ENFORCEMENT_LEVEL_REQUIRED,
        'iyr' => self::PASSWORD_PARAMETER_ENFORCEMENT_LEVEL_REQUIRED,
        'eyr' => self::PASSWORD_PARAMETER_ENFORCEMENT_LEVEL_REQUIRED,
        'hgt' => self::PASSWORD_PARAMETER_ENFORCEMENT_LEVEL_REQUIRED,
        'hcl' => self::PASSWORD_PARAMETER_ENFORCEMENT_LEVEL_REQUIRED,
        'ecl' => self::PASSWORD_PARAMETER_ENFORCEMENT_LEVEL_REQUIRED,
        'pid' => self::PASSWORD_PARAMETER_ENFORCEMENT_LEVEL_REQUIRED,
        'cid' => self::PASSWORD_PARAMETER_ENFORCEMENT_LEVEL_OPTIONAL,
    ];  
    
    public function __construct($record)
    {
        foreach (self::PASSWORD_PARAMETERS as $parameterName => $parameterEnforcementLevel) {
            $regex = sprintf('/%s:(.*)(.*)(\s|$)/mU', $parameterName);
            preg_match($regex, $record, $matches);
            $this->$parameterName = $matches[2] ?? null;
        }        
    }

    public function isValid($validateFieldContent = false): bool
    {
        foreach (self::PASSWORD_PARAMETERS as $parameterName => $parameterEnforcementLevel) {
            if ($this->$parameterName === null && $parameterEnforcementLevel === self::PASSWORD_PARAMETER_ENFORCEMENT_LEVEL_REQUIRED) {
                return false;
            }            
            
            if ($validateFieldContent && $parameterEnforcementLevel === self::PASSWORD_PARAMETER_ENFORCEMENT_LEVEL_REQUIRED) {
                $validator = 'AOC2020\Day4\Validators::validate' . ucfirst($parameterName);                
                if (!call_user_func($validator,$this->$parameterName)) {
                    return false;
                }
            }
        }
        
        return true;
    }    

}