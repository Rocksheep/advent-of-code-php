<?php

namespace App\AdventOfCode\Year2020\Day5;

class Range
{
    private int $min;
    private int $max;

    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function getMin(): int
    {
        return $this->min;
    }

    public function getMax(): int
    {
        return $this->max;
    }

    public function delta(): int
    {
        return $this->max - $this->min;
    }
}
