<?php

namespace App\AdventOfCode\Year2020\Day4;

use App\Collection;

class Passport
{
    private Collection $fields;
    private Collection $validationRules;

    public function __construct(Collection $fields, Collection $validationRules)
    {
        $this->fields = $fields;
        $this->validationRules = $validationRules;
    }

    public function isValid(): bool
    {
        foreach ($this->validationRules as $validationRule) {
            if (!$validationRule->isValid($this)) {
                return false;
            }
        }

        return true;
    }

    public function getFields(): Collection
    {
        return $this->fields;
    }
}
