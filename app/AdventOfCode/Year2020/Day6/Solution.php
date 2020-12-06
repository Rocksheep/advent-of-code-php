<?php

namespace App\AdventOfCode\Year2020\Day6;

use App\Collection;
use App\InputInterface;
use App\SolutionInterface;

class Solution implements SolutionInterface
{
    public function partOne(InputInterface $input): string
    {
        $groups = Collection::fromArray($input->split("\n\n"));
        $groups = $groups->map(function ($group) {
            $filledForms = Collection::fromArray(explode("\n", $group));
            $filledForms = $filledForms->map(fn ($filledForm) => new FilledForm($filledForm));

            return new TravelGroup($filledForms);
        });

        return $groups->reduce(function ($sum, $group) {
            return $sum + $group->questionsAnsweredWithYes();
        }, 0);
    }

    public function partTwo(InputInterface $input): string
    {
        $groups = Collection::fromArray($input->split("\n\n"));
        $groups = $groups->map(function ($group) {
            $filledForms = Collection::fromArray(explode("\n", $group));
            $filledForms = $filledForms->map(fn ($filledForm) => new FilledForm($filledForm));

            return new TravelGroup($filledForms);
        });

        $groups->get(1)->questionsAnsweredByEveryoneWithYes();
        return $groups->reduce(function ($sum, $group) {
            return $sum + $group->questionsAnsweredByEveryoneWithYes();
        }, 0);
    }
}
