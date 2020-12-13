<?php

namespace AOC2020\Day12;


class Ship
{
    private const DIRECTION_NORTH = "N";
    private const DIRECTION_EAST = "E";
    private const DIRECTION_SOUTH = "S";
    private const DIRECTION_WEST = "W";
    
    private const DIRECTIONS = [
        self::DIRECTION_NORTH => 0,
        self::DIRECTION_EAST => 1,
        self::DIRECTION_SOUTH => 2,
        self::DIRECTION_WEST => 3,
    ];
    
    private const INSTRUCTION_MOVE_NORTH =  'N';
    private const INSTRUCTION_MOVE_EAST =  'E';
    private const INSTRUCTION_MOVE_SOUTH =  'S';
    private const INSTRUCTION_MOVE_WEST =  'W';
    private const INSTRUCTION_MOVE_FORWARD =  'F';    
    private const INSTRUCTION_MOVE_RIGHT =  'R';    
    private const INSTRUCTION_MOVE_LEFT =  'L';    
    
    public const NAVIGATION_MODE_DIRECT = 'direct';
    public const NAVIGATION_MODE_WAYPOINT = 'waypoint';

    public function __construct(private array $instructions, private string $currentDirection, private array $currentPosition, private string $navigationMode = self::NAVIGATION_MODE_DIRECT, private array $currentWaypointPosition = ['x' => 0, 'y' => 0]) {}

    /**
     * process all instruction and return manhattan distance
     * 
     * @return int
     */
    public function processAllInstructions(): int {
       foreach ($this->instructions as $instruction) {
           $currentInstruction = $instruction[0];
           $currentQuantifier = (int) substr($instruction, 1);
           $this->doInstruction($currentInstruction, $currentQuantifier);           
       } 
       
       return $this->getManhattanSum();
    }
    
    private function doInstruction(string $instruction, int $quantifier) {
        $coordinatesTarget = [];
        if ($this->navigationMode === self::NAVIGATION_MODE_DIRECT) {
            $coordinatesTarget = &$this->currentPosition;
        } else if ($this->navigationMode === self::NAVIGATION_MODE_WAYPOINT) {
            $coordinatesTarget = &$this->currentWaypointPosition;
        }
        
        if ($instruction === self::INSTRUCTION_MOVE_NORTH) {
            $coordinatesTarget['y'] += $quantifier;
        }
        if ($instruction === self::INSTRUCTION_MOVE_EAST) {
            $coordinatesTarget['x'] += $quantifier;
        }
        if ($instruction === self::INSTRUCTION_MOVE_SOUTH) {
            $coordinatesTarget['y'] -= $quantifier;
        }
        if ($instruction === self::INSTRUCTION_MOVE_WEST) {
            $coordinatesTarget['x'] -= $quantifier;
        }
        if ($instruction === self::INSTRUCTION_MOVE_FORWARD && $this->navigationMode === self::NAVIGATION_MODE_DIRECT) {
            $this->doInstruction($this->currentDirection, $quantifier);
        } elseif ($instruction === self::INSTRUCTION_MOVE_FORWARD && $this->navigationMode === self::NAVIGATION_MODE_WAYPOINT) {
            $this->currentPosition['x'] = $this->currentPosition['x'] + ($this->currentWaypointPosition['x'] * $quantifier); 
            $this->currentPosition['y'] = $this->currentPosition['y'] + ($this->currentWaypointPosition['y'] * $quantifier); 
        }
        if ($instruction === self::INSTRUCTION_MOVE_RIGHT || $instruction === self::INSTRUCTION_MOVE_LEFT) {
            if ($this->navigationMode === self::NAVIGATION_MODE_DIRECT) {
                $this->currentDirection = $this->newDirection($this->currentDirection, $instruction, $quantifier);
            } elseif ($this->navigationMode === self::NAVIGATION_MODE_WAYPOINT) {
                $this->newWaypointPosition($instruction, $quantifier);
            }
        }        
    }

    private function getCurrentDirectionSymbol(int $currentDirectionNumber): string
    {
        return array_search($currentDirectionNumber, self::DIRECTIONS);
    }

    private function getManhattanSum(): int
    {
        return abs($this->currentPosition['x']) + abs($this->currentPosition['y']); 
    }
    
    private function newDirection(string $oldDirection, string $instruction, int $angle): string {
        $directionInt = self::DIRECTIONS[$oldDirection];
        for ($i = 0; $i < ($angle / 90); $i++) {
            if ($instruction === self::INSTRUCTION_MOVE_RIGHT) {
                $directionInt++;
            } elseif ($instruction === self::INSTRUCTION_MOVE_LEFT) {
                $directionInt--;
            }
            if ($directionInt === -1) {
                $directionInt = 3;
            }
            if ($directionInt === 4) {
                $directionInt = 0;
            }            
        }
        
        return $this->getCurrentDirectionSymbol($directionInt);
    }

    private function newWaypointPosition(string $instruction, int $quantifier): void
    {         
        $steps = $quantifier / 90;
        
        for ($i = 0; $i < $steps; $i++) {
            $this->currentWaypointPosition = $this->swapAxis($this->currentWaypointPosition);
            $this->currentWaypointPosition = $this->swapCoordinatesSign($this->currentWaypointPosition, $instruction);
        }
    }

    private function swapAxis(array $coordinates): array 
    {
        return ['x' => $coordinates['y'], 'y' => $coordinates['x']];
    }
    
    private function swapCoordinatesSign(array $coordinates, string $direction): array {
        if ($direction === self::INSTRUCTION_MOVE_RIGHT) {
            return ['x' => $coordinates['x'], 'y' => $coordinates['y']*(-1)];
        } else {
            return ['x' => $coordinates['x']*(-1), 'y' => $coordinates['y']];
        }
    }
}