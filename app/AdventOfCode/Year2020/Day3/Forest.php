<?php

namespace App\AdventOfCode\Year2020\Day3;

use App\Collection;

class Forest
{
    private Collection $treeMap;

    public function __construct(Collection $treeMap)
    {
        $this->treeMap = $treeMap;
    }

    public function isTree(int $x, int $y): bool
    {
        $line = $this->treeMap->get($y);
        $char = $x % strlen($line);

        return $line[$char] === '#';
    }

    public function length(): int
    {
        return $this->treeMap->count();
    }
}
