<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\GeneratorInterface;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;

/**
 * Generator for `dist/app/Models/*.php`.
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
        private ?string $dist = null
    ) {
        if (is_null($dist)) {
            $this->dist = Path::model();
        }

        $this->stub = file_get_contents(Path::stub().'Model.stub');
    }

    /**
     * {@inheritDoc}
     */
    public function run(): void
    {
        $seederClass = str_replace(
            ['{model}'],
            [$this->table->model()],
            $this->stub
        );

        file_put_contents(
            $this->dist.$this->table->model().'.php',
            $seederClass
        );
    }

    /**
     * Factory method.
     *
     * @param  Table  $table  The model class name
     * @param  string  $namespace  The model namespace
     * @param  string  $dist  The path to the dist folder
     *
     * @example \Generators\ModelGenerator::make('User')
     * @example \Generators\ModelGenerator::make('User', 'App\Models')
     * @example \Generators\ModelGenerator::make('User', 'App\Models', 'dist/app/Models')
     */
    public static function make(
        Table $table,
        ?string $namespace = null,
        ?string $dist = null
    ): static {
        return new self($table, $namespace, $dist);
    }
}
