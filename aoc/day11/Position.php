<?php

namespace AOC2020\Day11;


class Position
{
    public const TYPE_SEAT = 'L';
    public const TYPE_PERSON = '#';
    public const TYPE_FLOOR = '.';

    private const TYPES = [
        self::TYPE_SEAT,
        self::TYPE_PERSON,
        self::TYPE_FLOOR,
    ];


    private const ADJACENT_SEATS_OCCUPIED_TO_SIT_DOWN = 0;

    public const DECISION_NEXT = 'next';
    public const DECISION_NEAREST_IN_SIGHT = 'nearest';


    private string $nextTurnState;

    public function __construct(public int $x, public int $y, public string $type, public array &$map, private int $mapHeight, private int $mapWidth, private int $seatsOccupiedToStandUp, private string $decisionBy)
    {
        $this->nextTurnState = $this->type;
    }

    /**
     * prepare change for next turn and return true if state (type) would have changed
     *
     * @return bool
     */
    public function prepareTurn(): bool
    {
        if ($this->decisionBy === self::DECISION_NEXT) {
            $adjacentSeatsTypes = $this->getAdjacentTypesCount();
        } else {
            $adjacentSeatsTypes = $this->getNearestTypesCount();
        }

        if ($this->type === self::TYPE_FLOOR) {
            return false;
        }

        if ($this->type === self::TYPE_SEAT && $adjacentSeatsTypes[self::TYPE_PERSON] === self::ADJACENT_SEATS_OCCUPIED_TO_SIT_DOWN) {
            $this->nextTurnState = self::TYPE_PERSON;

            return true;
        }

        if ($this->type === self::TYPE_PERSON && $adjacentSeatsTypes[self::TYPE_PERSON] >= $this->seatsOccupiedToStandUp) {
            $this->nextTurnState = self::TYPE_SEAT;

            return true;
        }

        return false;
    }

    public function doTurn(): void
    {
        $this->type = $this->nextTurnState;
    }

    private function getAdjacentTypesCount(): array
    {
        $adjacentListCount = [];
        foreach (self::TYPES as $type) {
            $adjacentListCount[$type] = 0;
        }

        for ($x = max(0, $this->x - 1); $x <= min($this->mapWidth, $this->x + 1); $x++) {
            for ($y = max(0, $this->y - 1); $y <= min($this->mapHeight, $this->y + 1); $y++) {
                if ($x === $this->x && $y === $this->y) {
                    continue;
                }
                $adjacentListCount[$this->map[$y][$x]->type]++;
            }
        }


        return $adjacentListCount;
    }

    private function getNearestTypesCount(): array
    {
        $nearestListCount = [];
        foreach (self::TYPES as $type) {
            $nearestListCount[$type] = 0;
        }

        $directions = [
            //y,x            
            ['y' => -1, 'x' => -1], //up left
            ['y' => -1, 'x' => 0],  //up
            ['y' => -1, 'x' => 1],  //up right
            ['y' => 0, 'x' => 1],   //right
            ['y' => 1, 'x' => 1],   //down right
            ['y' => 1, 'x' => 0],   //down
            ['y' => 1, 'x' => -1],  //down left
            ['y' => 0, 'x' => -1],  //left
        ];

        foreach ($directions as $direction) {
            $directionResult = $this->getNearestType($direction, $this->x, $this->y);
            if ($directionResult) {
                $nearestListCount[$directionResult]++;
            }
        }

        return $nearestListCount;
    }


    public function getNearestType(array $directions, $currentX, $currentY): string|null
    {
        $tmpX = $currentX + $directions['x'];
        $tmpY = $currentY + $directions['y'];

        if ($tmpX < 0 || $tmpX > $this->mapWidth || $tmpY < 0 || $tmpY > $this->mapHeight) {
            return null;
        } elseif ($this->map[$tmpY][$tmpX]->type === self::TYPE_FLOOR) {
            return $this->getNearestType($directions, $tmpX, $tmpY);
        } else {
            return $this->map[$tmpY][$tmpX]->type;
        }
    }

}