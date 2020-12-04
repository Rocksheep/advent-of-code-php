<?php

namespace App\AdventOfCode\Year2020\Day4;

use App\Collection;

class ContainsRequiredFields implements PassportValidationRuleContract
{
    private Collection $requiredFields;

    public function __construct()
    {
        $this->requiredFields = Collection::fromArray([
            'byr',
            'iyr',
            'eyr',
            'hgt',
            'hcl',
            'ecl',
            'pid'
        ]);
    }

    public function isValid(Passport $passport): bool
    {
        $passportFields = $passport->getFields();

        foreach ($this->requiredFields as $field) {
            if (!$passportFields->hasKey($field)) {
                return false;
            }
        }

        return true;
    }
}
