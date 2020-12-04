<?php

namespace App\AdventOfCode\Year2020\Day4;

class HeightValidationRule implements PassportValidationRuleContract
{
    public function isValid(Passport $passport): bool
    {
        if (!$passport->getFields()->hasKey('hgt')) {
            return false;
        }

        $height = $passport->getFields()->get('hgt');

        $unit = substr($height, -2);
        $value = intval(substr($height, 0, -2));

        if ($unit === 'cm') {
            return 150 <= $value && $value <= 193;
        }

        return 59 <= $value && $value <= 76;
    }
}
