<?php

namespace App\AdventOfCode\Year2020\Day2;

use App\Collection;

class CharacterMatchValidationRule implements ValidationRule
{
    private Collection $indexes;
    private string $char;

    public function __construct(Collection $indexes, string $char)
    {
        $this->indexes = $indexes;
        $this->char = $char;
    }

    public function isValid(Password $password): bool
    {
        $matches = $this->indexes->reduce(function ($matches, $index) use ($password) {
            $correctedIndex = $index - 1;
            if ($password->getValue()[$correctedIndex] === $this->char) {
                return $matches + 1;
            }

            return $matches;
        }, 0);

        return $matches === 1;
    }
}
