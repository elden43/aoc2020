<?php

namespace AOC2020\Day3;


class Toboggan
{

    public function __construct(private array $map, private int $xStep, private int $yStep) { }
    
    public function getHittedTrees() {        
        $columnsCount = count($this->map[0]);
        $rowsCount = count($this->map);
        $hittedTrees = 0;
        $currentX = 0;
        $currentY = 0;
        
        while ($currentY < $rowsCount) {
            if ($this->map[$currentY][$currentX] === '#') {
                $hittedTrees++;
            }
            if ($currentX + $this->xStep + 1 > $columnsCount) {
                $currentX = $currentX + $this->xStep - $columnsCount;
            }
            else {
                $currentX += $this->xStep;
            }
            $currentY += $this->yStep;
        }
        
        return $hittedTrees;        
    }   

}