<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;

abstract class Generator
{
    protected string $stub;

    protected ?string $namespace;

    protected function __construct(
        protected Table $table,
        ?string $namespace = null,
        protected ?string $destination = null
    ) {
        $this->namespace = $namespace;
    }

    protected function loadStub(string $filename): void
    {
        $this->stub = $this->read(Path::stub().DIRECTORY_SEPARATOR.$filename);
    }

    protected function defaultDestination(string $path): void
    {
        if (is_null($this->destination)) {
            $this->destination = $path;
        }
    }

    protected function defaultNamespace(string $namespace): void
    {
        if (is_null($this->namespace)) {
            $this->namespace = $namespace;
        }
    }

    protected function qualifyModel(string $class): string
    {
        return $this->namespace.'\\'.$class;
    }

    protected function write(string $filename, string $content, bool $force = false): void
    {
        File::system()->write($this->destination.DIRECTORY_SEPARATOR.$filename, $content, $force);
    }

    protected function read(string $filename): string
    {
        return File::system()->read($filename);
    }

    protected function replace(array $search, array $replace): string
    {
        return str_replace($search, $replace, $this->stub);
    }
}
