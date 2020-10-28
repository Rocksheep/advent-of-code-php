<?php

namespace App\Commands;

use Illuminate\Console\GeneratorCommand;

class AdventGenerator extends GeneratorCommand
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'advent:generate {name}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create a solution class from a stub';

    protected function getStub()
    {
        return base_path('stubs/solution.stub');
    }
}
