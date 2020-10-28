<?php

namespace App;

class StringInput implements InputInterface
{
    public function read(): string
    {
        return 'swag';
    }
}
