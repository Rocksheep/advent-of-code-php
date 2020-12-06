<?php

namespace App\AdventOfCode\Year2020\Day5;

use App\Collection;
use App\InputInterface;
use App\SolutionInterface;

class Solution implements SolutionInterface
{
    public function partOne(InputInterface $input): string
    {
        $boardingPasses = $this->getBoardingPassesFromInput($input);

        return $boardingPasses->reduce(function ($highestSeatID, $boardingPass) {
            return max($highestSeatID, $boardingPass->seatID());
        }, 0);
    }

    public function partTwo(InputInterface $input): string
    {
        $boardingPasses = $this->getBoardingPassesFromInput($input);

        $seatIDs = $boardingPasses->map(function ($boardingPass) {
            return $boardingPass->seatID();
        })->sort();

        for ($i = 1; $i < $seatIDs->count() - 2; $i++) {
            $previousSeat = $seatIDs->get($i-1);
            $currentSeat = $seatIDs->get($i);

            if ($previousSeat === $currentSeat - 2) {
                return $currentSeat - 1;
            }
        }

        return '';
    }

    private function getBoardingPassesFromInput(InputInterface $input): Collection
    {
        return Collection::fromArray($input->split("\n"))
            ->map(function ($seatCode) {
                return new BoardingPass($seatCode);
            });
    }
}
