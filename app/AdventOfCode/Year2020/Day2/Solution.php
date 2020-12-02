<?php

namespace App\AdventOfCode\Year2020\Day2;

use App\Collection;
use App\InputInterface;
use App\SolutionInterface;

class Solution implements SolutionInterface
{
    public function partOne(InputInterface $input): string
    {
        return $this->parse($input, function ($matches) {
            $min = intval($matches[1]);
            $max = intval($matches[2]);
            $char = $matches[3];

            return new PasswordValidationRule($min, $max, $char);
        });
    }

    public function partTwo(InputInterface $input): string
    {
        return $this->parse($input, function ($matches) {
            $indexes = Collection::fromArray([intval($matches[1]), intval($matches[2])]);
            $char = $matches[3];

            return new CharacterMatchValidationRule($indexes, $char);
        });
    }

    private function parse(InputInterface $input, callable $callback): int
    {
        $splitInput = Collection::fromArray($input->split("\n"));

        return $splitInput->reduce(function ($numberOfCorrectPasswords, $line) use ($callback) {
            $matches = null;
            $hasMatched = preg_match('/(\d+)-(\d+) (\w): (\w+)/', $line, $matches);

            if ($hasMatched === 0) {
                return $numberOfCorrectPasswords;
            }

            $validationRule = $callback($matches);
            $password = new Password($matches[4]);

            if ($validationRule->isValid($password)) {
                return $numberOfCorrectPasswords + 1;
            }

            return $numberOfCorrectPasswords;
        }, 0);
    }
}
