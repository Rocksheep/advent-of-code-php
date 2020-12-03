<?php

namespace App\Commands;

use App\StringInput;
use App\SolutionInterface;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;
use LaravelZero\Framework\Commands\Command;

class AdventRun extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'advent:run {year?} {solution?}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Run the solution for the given year and day';

    /**
     * Execute the console command.
     *
     * @param int|null $year
     * @param int|null $solution
     *
     * @return mixed
     */
    public function handle()
    {
        $currentDate = Carbon::now();

        $year = $this->argument('year');
        if (!$year) {
            $year = $this->ask('For what year do you want to execute code', $currentDate->year);
        }

        $solution = $this->argument('solution');
        if (!$solution) {
            $solution = $this->ask('Which solution do you want to execute', min($currentDate->day, 25));
        }

        $class = sprintf('App\AdventOfCode\Year%s\Day%s\Solution', $year, $solution);
        if (!class_exists($class)) {
            $this->error('Solution not found');

            return -1;
        }

        try {
            $input = $this->getFileInput($year, $solution);
        } catch (FileNotFoundException $e) {
            $this->error($e->getMessage());

            return 1;
        }
        /** @var SolutionInterface $instance */
        $instance = new $class();

        $this->table(
            ['Part one', 'Part two'],
            [[$instance->partOne($input), $instance->partTwo($input)]]
        );

        return 0;
    }

    /**
     * @param int $year
     * @param int $solution
     * @return StringInput
     * @throws FileNotFoundException
     */
    protected function getFileInput(int $year, int $solution): StringInput
    {
        $filePath = storage_path(sprintf('AdventOfCode/Year%s/Day%s/input.txt', $year, $solution));

        if (!File::exists($filePath)) {
            throw new FileNotFoundException(sprintf('Input file for %s - day %s does not exist', $year, $solution));
        }

        return new StringInput(trim(File::get($filePath)));
    }
}
