<?php

namespace App\AdventOfCode\Year2020\Day4;

class BirthYearValidationRule implements PassportValidationRuleContract
{
    public function isValid(Passport $passport): bool
    {
        if (!$passport->getFields()->hasKey('byr')) {
            return false;
        }
        $birthYear = intval($passport->getFields()->get('byr'));

        return 1920 <= $birthYear && $birthYear <= 2002;
    }
}
