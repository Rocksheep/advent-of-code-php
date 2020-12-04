<?php

namespace App\AdventOfCode\Year2020\Day4;

class HairColorValidationRule implements PassportValidationRuleContract
{
    public function isValid(Passport $passport): bool
    {
        if (!$passport->getFields()->hasKey('hcl')) {
            return false;
        }

        return preg_match('/^#[0-9a-f]{6}$/', $passport->getFields()->get('hcl'));
    }
}
