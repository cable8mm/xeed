<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;

abstract class Generator
{
    protected string $stub;

    protected function __construct(
        protected Table $table,
        protected ?string $namespace = null,
        protected ?string $destination = null
    ) {}

    protected function loadStub(string $filename): void
    {
        $this->stub = File::system()->read(Path::stub().DIRECTORY_SEPARATOR.$filename);
    }

    protected function defaultDestination(string $path): void
    {
        if (is_null($this->destination)) {
            $this->destination = $path;
        }
    }

    protected function write(string $filename, string $content, bool $force = false): void
    {
        File::system()->write($this->destination.DIRECTORY_SEPARATOR.$filename, $content, $force);
    }

    protected function replace(array $search, array $replace): string
    {
        return str_replace($search, $replace, $this->stub);
    }
}
