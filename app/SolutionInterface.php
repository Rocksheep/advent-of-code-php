<?php

namespace App;

interface SolutionInterface
{
    public function partOne(InputInterface $input): string;

    public function partTwo(InputInterface $input): string;
}
