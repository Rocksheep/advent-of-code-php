<?php

namespace App\Commands;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use LaravelZero\Framework\Commands\Command;

class AdventScaffold extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'advent:scaffold';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create the scaffold for advent of code';

    /** @var string */
    private $rootDirectory = 'AdventOfCode';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $currentDate = Carbon::now();
        $year = intval($this->ask('For what year do you want to create scaffolding?', $currentDate->year));

        $this->info('creating daily directories');
        for ($i = 1; $i <= 25; $i++) {
            $class = sprintf('%s/Year%s/Day%s/Solution', $this->rootDirectory, $year, $i);
            $this->call('advent:generate', ['name' => $class]);

            $this->createInputFile($year, $i);
        }

        $this->info('Scaffolding completed. Happy Hacking!!!');
    }

    protected function createInputFile(int $year, int $day)
    {
        $inputDirectory = sprintf('%s/Year%s/Day%s', $this->rootDirectory, $year, $day);
        Storage::makeDirectory($inputDirectory);

        $inputFilePath = storage_path(sprintf('%s/input.txt', $inputDirectory));

        File::put($inputFilePath, '');
    }
}
