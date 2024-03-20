<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\GeneratorInterface;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;

/**
 * Generator for `dist/app/Models/*.php`.
 *
 * @throws Exception \League\Flysystem\FilesystemException
 * @throws Exception \League\Flysystem\UnableToReadFile
 */
final class ModelGenerator implements GeneratorInterface
{
    /**
     * @var string Stub string from the stubs folder file.
     */
    private string $stub;

    private function __construct(
        private Table $table,
        private ?string $namespace_class,
        private ?string $destination = null
    ) {
        if (is_null($destination)) {
            $this->destination = Path::model();
        }

        $this->stub = File::system()->read(Path::stub().'Model.stub');
    }

    /**
     * {@inheritDoc}
     */
    public function run(bool $force = false): void
    {
        $seederClass = str_replace(
            ['{model}'],
            [$this->table->model()],
            $this->stub
        );

        File::system()->write(
            $this->destination.$this->table->model().'.php',
            $seederClass,
            $force
        );
    }

    /**
     * Factory method.
     *
     * @param  Table  $table  The model class name
     * @param  string  $namespace  The model namespace
     * @param  string  $destination  The path to the dist folder
     *
     * @example \Generators\ModelGenerator::make('User')
     * @example \Generators\ModelGenerator::make('User', 'App\Models')
     * @example \Generators\ModelGenerator::make('User', 'App\Models', 'dist/app/Models')
     */
    public static function make(
        Table $table,
        ?string $namespace = null,
        ?string $destination = null
    ): static {
        return new self($table, $namespace, $destination);
    }
}
