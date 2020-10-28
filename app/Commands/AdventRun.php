<?php

namespace App\Commands;

use App\SolutionInterface;
use App\StringInput;
use Carbon\Carbon;
use LaravelZero\Framework\Commands\Command;

class AdventRun extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'advent:run';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create the scaffold for advent of code';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $currentDate = Carbon::now();
        $year = $this->ask('For what year do you want to execute code', $currentDate->year);
        $solution = $this->ask('Which solution do you want to execute', min($currentDate->day, 25));

        $class = sprintf('App\AdventOfCode\Year%s\Day%s\Solution', $year, $solution);
        if (!class_exists($class)) {
            $this->error('Solution not found');

            return -1;
        }

        // if input exists
        // get input from file
        //
        /** @var SolutionInterface $instance */
        $instance = new $class();

        $input = new StringInput();

        $this->table(
            ['Part one', 'Part two'],
            [[$instance->partOne($input), $instance->partTwo($input)]]
        );

        return 0;
    }
}
