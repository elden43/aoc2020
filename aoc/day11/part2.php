<?php

namespace AOC2020\Day11;

set_time_limit(0);

include 'Position.php';

$inputFile = 'input.txt';

$rows = explode(PHP_EOL, file_get_contents($inputFile));
foreach ($rows as $row) {
    $map[] = str_split(trim($row));
}

$mapMaxY = count($map) - 1;
$mapMaxX = count($map[0]) - 1;

foreach ($map as $yPosition => $mapRow) {
    foreach ($mapRow as $xPosition => $seat) {
        $map[$yPosition][$xPosition] = new Position($xPosition, $yPosition, $seat, $map, $mapMaxY, $mapMaxX, 5, Position::DECISION_NEAREST_IN_SIGHT);
    }
}

$anyChangeHappened = true;
while ($anyChangeHappened) {
    $anyChangeHappened = false;
    foreach ($map as $row) {
        /** @var \AOC2020\Day11\Position $position */
        foreach ($row as $position) {
            if ($position->prepareTurn()) {
                $anyChangeHappened = true;
            }
        }
    }
    if ($anyChangeHappened) {
        foreach ($map as $row) {
            /** @var \AOC2020\Day11\Position $position */
            foreach ($row as $position) {
                $position->doTurn();
            }
        }
    }
}

$occupied = 0;
foreach ($map as $row) {
    /** @var \AOC2020\Day11\Position $position */
    foreach ($row as $position) {
        if ($position->type === Position::TYPE_PERSON) {
            $occupied++;
        }
    }
}
echo $occupied;