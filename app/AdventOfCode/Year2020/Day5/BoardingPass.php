<?php

namespace App\AdventOfCode\Year2020\Day5;

class BoardingPass
{
    private string $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function seatID(): int
    {
        return $this->seatRow() * 8 + $this->seatCol();
    }

    public function seatRow(): int
    {
        $rowRange = new Range(0, 127);

        for ($i = 0; $i < strlen($this->code); $i++) {
            if ($this->code[$i] === 'F') {
                $newMax = (int) ($rowRange->getMax() - $rowRange->delta() / 2);
                $rowRange = new Range($rowRange->getMin(), $newMax);
            } else if ($this->code[$i] === 'B') {
                $newMin = (int) ($rowRange->getMin() + $rowRange->delta() / 2 + 0.5);
                $rowRange = new Range($newMin, $rowRange->getMax());
            }
        }

        return $rowRange->getMin();
    }

    public function seatCol(): int
    {
        $colRange = new Range(0, 7);

        for ($i = 0; $i < strlen($this->code); $i++) {

            if ($this->code[$i] === 'L') {
                $newMax = (int) ($colRange->getMax() - $colRange->delta() / 2);
                $colRange = new Range($colRange->getMin(), $newMax);
            } else if ($this->code[$i] === 'R') {
                $newMin = (int) ($colRange->getMin() + $colRange->delta() / 2 + 0.5);
                $colRange = new Range($newMin, $colRange->getMax());
            }
        }

        return $colRange->getMin();
    }
}
