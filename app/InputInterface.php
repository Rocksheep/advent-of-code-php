<?php

namespace App;

interface InputInterface
{
    public function read(): string;

    public function split(string $delimiter);
}
