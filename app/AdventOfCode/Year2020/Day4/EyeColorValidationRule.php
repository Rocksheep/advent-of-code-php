<?php

namespace App\AdventOfCode\Year2020\Day4;

class EyeColorValidationRule implements PassportValidationRuleContract
{
    public function isValid(Passport $passport): bool
    {
        if (!$passport->getFields()->hasKey('ecl')) {
            return false;
        }

        $eyeColor = $passport->getFields()->get('ecl');

        return in_array($eyeColor, [
            'amb',
            'blu',
            'brn',
            'gry',
            'grn',
            'hzl',
            'oth',
        ]);
    }
}
