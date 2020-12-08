<?php


namespace AOC2020\Day8;


class Command
{
    public const COMMAND_ACC = 'acc';
    public const COMMAND_JMP = 'jmp';
    public const COMMAND_NOP = 'nop';
    public const COMMAND_FIN = 'fin'; //virtual instruction meaning programme finished successfully
    
    private const AVAILABLE_COMMANDS = [
        self::COMMAND_ACC,
        self::COMMAND_JMP,
        self::COMMAND_NOP,
        self::COMMAND_FIN,
    ];
    
    public function __construct(public string $operation, public int $quantifier,) { }
    
    public function changeCommand(string $newOperation) {
        if (in_array($newOperation, self::AVAILABLE_COMMANDS)) {
            $this->operation = $newOperation;
        }
    }
}