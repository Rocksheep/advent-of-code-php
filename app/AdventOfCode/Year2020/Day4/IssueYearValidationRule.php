<?php

namespace App\AdventOfCode\Year2020\Day4;

class IssueYearValidationRule implements PassportValidationRuleContract
{
    public function isValid(Passport $passport): bool
    {
        if (!$passport->getFields()->hasKey('iyr')) {
            return false;
        }
        $issueYear = intval($passport->getFields()->get('iyr'));

        return 2010 <= $issueYear && $issueYear <= 2020;
    }
}
