<?php

namespace App;

class StringInput implements InputInterface
{
    /** @var string */
    private string $originalValue;

    public function __construct(string $originalValue)
    {
        $this->originalValue = $originalValue;
    }

    public function read(): string
    {
        return $this->originalValue;
    }

    public function split(string $delimiter): array
    {
        return explode($delimiter, $this->originalValue);
    }
}
