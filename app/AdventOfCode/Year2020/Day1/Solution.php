<?php

namespace App\AdventOfCode\Year2020\Day1;

use App\Collection;
use App\InputInterface;
use App\SolutionInterface;

class Solution implements SolutionInterface
{
    public function partOne(InputInterface $input): string
    {
        $splitInput = Collection::fromArray($input->split("\n"));

        $expenseReport = $splitInput->map(function ($value) {
            return new Expense(intval($value));
        });

        $expenseReportClone = clone $expenseReport;

        foreach ($expenseReport as $i => $expenseA) {
            foreach ($expenseReportClone as $j => $expenseB) {
                if ($i === $j) {
                    continue;
                }

                if ($expenseA->getValue() + $expenseB->getValue() === 2020) {
                    return $expenseA->getValue() * $expenseB->getValue();
                }
            }
        }

        return '';
    }

    public function partTwo(InputInterface $input): string
    {
        $splitInput = $input->split("\n");
        array_pop($splitInput);
        $splitInput = Collection::fromArray($splitInput);

        $expenseReportA = $splitInput->map(function ($value) {
            return new Expense(intval($value));
        });

        $expenseReportB = clone $expenseReportA;
        $expenseReportC = clone $expenseReportB;

        foreach ($expenseReportA as $i => $expenseA) {
            foreach ($expenseReportB as $j => $expenseB) {
                foreach ($expenseReportC as $k => $expenseC) {
                    if ($i === $j || $i === $k || $j === $k) {
                        continue;
                    }

                    if ($expenseA->getValue() + $expenseB->getValue() + $expenseC->getValue() === 2020) {
                        printf("%d, %d, %d\n", $expenseA->getValue(), $expenseB->getValue(), $expenseC->getValue());
                        return $expenseA->getValue() * $expenseB->getValue() * $expenseC->getValue();
                    }
                }
            }
        }

        return '';
    }
}
