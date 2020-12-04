<?php

namespace App\AdventOfCode\Year2020\Day4;

class ExpirationYearValidationRule implements PassportValidationRuleContract
{
    public function isValid(Passport $passport): bool
    {
        if (!$passport->getFields()->hasKey('eyr')) {
            return false;
        }
        $expirationYear = intval($passport->getFields()->get('eyr'));

        return 2020 <= $expirationYear && $expirationYear <= 2030;
    }
}
