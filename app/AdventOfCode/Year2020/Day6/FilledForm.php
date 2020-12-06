<?php

namespace App\AdventOfCode\Year2020\Day6;

use App\Collection;

class FilledForm
{
    private string $answers;

    public function __construct(string $answers)
    {
        $this->answers = $answers;
    }

    public function questionsAnsweredWithYes(): Collection
    {
        $questions = new Collection();
        for ($i = 0; $i < strlen($this->answers); $i++) {
            $questions->add($this->answers[$i]);
        }

        return $questions;
    }
}
