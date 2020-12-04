<?php

namespace App\AdventOfCode\Year2020\Day4;

class PassportIDValidationRule implements PassportValidationRuleContract
{
    public function isValid(Passport $passport): bool
    {
        if (!$passport->getFields()->hasKey('pid')) {
            return false;
        }

        return preg_match('/^[0-9]{9}$/', $passport->getFields()->get('pid'));
    }
}
