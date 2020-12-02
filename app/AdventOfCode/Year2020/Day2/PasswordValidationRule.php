<?php

namespace App\AdventOfCode\Year2020\Day2;

class PasswordValidationRule implements ValidationRule
{
    private int $min;
    private int $max;
    private string $char;

    public function __construct(int $min, int $max, string $char)
    {
        $this->min = $min;
        $this->max = $max;
        $this->char = $char;
    }

    public function isValid(Password $password): bool
    {
        $charCount = substr_count($password->getValue(), $this->char);

        return $charCount >= $this->min && $charCount <= $this->max;
    }
}
