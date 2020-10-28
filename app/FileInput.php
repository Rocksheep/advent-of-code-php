<?php

namespace App;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;

class FileInput implements InputInterface
{
    /** @var string */
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @return string
     * @throws FileNotFoundException
     */
    public function read(): string
    {
        if (!File::exists($this->filePath)) {
            throw new FileNotFoundException(sprintf('File %s not found', $this->filePath));
        }

        return File::get($this->filePath);
    }
}
