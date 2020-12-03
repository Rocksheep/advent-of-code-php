<?php

namespace App\AdventOfCode\Year2020\Day3;

use App\Collection;
use App\InputInterface;
use App\SolutionInterface;

class Solution implements SolutionInterface
{
    public function partOne(InputInterface $input): string
    {
        $lines = Collection::fromArray($input->split("\n"));
        $forest = new Forest($lines);
        $slope = new Slope(3, 1);
        $person = new Person(0, 0, $forest);

        for ($i = 0; $i < $lines->count() - 1; $i += $slope->getY()) {
            $person->goDownSlope($slope);
        }

        return $person->getTreesEncountered();
    }

    public function partTwo(InputInterface $input): string
    {
        $lines = Collection::fromArray($input->split("\n"));
        $forest = new Forest($lines);

        $slopes = Collection::fromArray([
            new Slope(1, 1),
            new Slope(3, 1),
            new Slope(5, 1),
            new Slope(7, 1),
            new Slope(1, 2),
        ]);

        return $slopes->reduce(function ($value, $slope) use ($forest) {
            $person = new Person(0, 0, $forest);

            for ($i = 0; $i < $forest->length() - 1; $i += $slope->getY()) {
                $person->goDownSlope($slope);
            }

            if ($value == 0) {
                return $value + $person->getTreesEncountered();
            }

            return $value * $person->getTreesEncountered();
        }, 0);
    }
}
