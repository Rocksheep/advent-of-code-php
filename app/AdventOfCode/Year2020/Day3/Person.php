<?php

namespace App\AdventOfCode\Year2020\Day3;

class Person
{
    private int $x;
    private int $y;
    private Forest $forest;
    private int $treesEncountered;

    public function __construct(int $x, int $y, Forest $forest)
    {
        $this->x = $x;
        $this->y = $y;
        $this->forest = $forest;
        $this->treesEncountered = 0;
    }

    public function goDownSlope(Slope $slope)
    {
        $this->x += $slope->getX();
        $this->y += $slope->getY();

        $this->checkForTree();
    }

    public function checkForTree(): void
    {
        if ($this->forest->isTree($this->x, $this->y)) {
            $this->treesEncountered++;
        }
    }

    public function getTreesEncountered(): int
    {
        return $this->treesEncountered;
    }
}
