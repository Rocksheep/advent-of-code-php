<?php

namespace App\Commands;

use App\FileInput;
use App\SolutionInterface;
use App\StringInput;
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
    protected $signature = 'advent:run';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Run the solution for the given year and day';

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
     * @return FileInput
     * @throws FileNotFoundException
     */
    protected function getFileInput(int $year, int $solution): FileInput
    {
        $filePath = storage_path(sprintf('AdventOfCode/Year%s/Day%s/input.txt', $year, $solution));

        if (!File::exists($filePath)) {
            throw new FileNotFoundException(sprintf('Input file for %s - day %s does not exist', $year, $solution));
        }

        return new FileInput($filePath);
    }
}
