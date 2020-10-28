<?php

namespace App\Commands;

use Carbon\Carbon;
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
        $year = $this->ask('For what year do you want to create scaffolding?', $currentDate->year);
        $includeInputFolders = strtolower($this->ask('Do you want to prepare the input folders?', 'Y'));

        $this->info('creating daily directories');
        for ($i = 1; $i <= 25; $i++) {
            $class = sprintf('%s/Year%s/Day%s/Solution', $this->rootDirectory, $year, $i);
            $this->call('advent:generate', ['name' => $class]);
        }

        if ($includeInputFolders === 'y') {
            $this->info('Creating input folders');
        } else {
            $this->info('Skipping input folders');
        }

        $this->info('Scaffolding completed. Happy Hacking!!!');
    }
}
