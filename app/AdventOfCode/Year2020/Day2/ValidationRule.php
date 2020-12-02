<?php

namespace App\AdventOfCode\Year2020\Day2;

interface ValidationRule
{
    public function isValid(Password $password): bool;
}
