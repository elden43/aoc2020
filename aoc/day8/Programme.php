<?php

namespace AOC2020\Day8;

include_once 'Command.php';

class Programme
{    
    private string $programmeResult = '';
    private bool $running;    
    private int $pointer;    
    private int $accumulator = 0;    
    private array $alreadyRanCommands = [];
    public bool $successfullyFinished = false;
    private int $commandCount;

    /**
     * Programme constructor.
     *
     * @param \AOC2020\Day8\Command[] $sequence
     */    
    public function __construct(private array $sequence) {        
        array_push($this->sequence, new Command(Command::COMMAND_FIN, 0));
        $this->commandCount = count($this->sequence);
    }

    public function run(int $startOffset = 0): void
    {
        if(key_exists($startOffset, $this->sequence)) {
            $this->pointer = $startOffset;
            $this->running = true;
        } else {
            $this->programmeResult = 'Bad starting offset';
        }
        
        while ($this->running) {
            $this->executeCommand($this->sequence[$this->pointer]);
        }                
    }

    public function printResult(): void
    {
        echo $this->programmeResult;
    }

    private function executeCommand(Command $command): void
    {        
        if ($this->loopCheck()) {
            $this->running = false;
            $this->programmeResult = $this->accumulator;
            return;
        } else {
            $this->alreadyRanCommands[] = $this->pointer;
        }
        switch ($command->operation) {
            case Command::COMMAND_ACC:
                $this->accumulator += $command->quantifier;
                $this->pointer++;
                break;
            case Command::COMMAND_JMP:
                if (($this->pointer + $command->quantifier >= $this->commandCount) || ($this->pointer + $command->quantifier < 0)) {
                    $this->running = false;
                    $this->programmeResult = 'Error: out of bounds';                    
                }
                $this->pointer += $command->quantifier;
                break;
            case Command::COMMAND_NOP:
                $this->pointer++;
                break;
            case Command::COMMAND_FIN:
                $this->running = false;
                $this->programmeResult = $this->accumulator;
                $this->successfullyFinished = true;
            break;
        }
    }

    private function loopCheck(): bool
    {
        return in_array($this->pointer, $this->alreadyRanCommands);
    }
}