<?php

namespace App\AdventOfCode\Year2020\Day4;

interface PassportValidationRuleContract
{
    public function isValid(Passport $passport): bool;
}
