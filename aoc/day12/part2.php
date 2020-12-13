<?php

namespace AOC2020\Day12;

include "Ship.php";

$inputFile = 'input.txt';

$instructions = explode(PHP_EOL,file_get_contents($inputFile));

$ship = new Ship($instructions, 'E', ['x' => 0, 'y' => 0], Ship::NAVIGATION_MODE_WAYPOINT,  ['x' => 10, 'y' => 1]);
echo $ship->processAllInstructions();
    
    
    


