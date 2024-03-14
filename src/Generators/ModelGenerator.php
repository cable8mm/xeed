<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\Generator;
use Cable8mm\Xeed\Support\Inflector;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;

/**
 * Generator for `dist/app/Models/*.php`.
 */
final class ModelGenerator implements Generator
{
    /**
     * @var string Stub string from the stubs folder file.
     */
    private string $stub;

    /**
     * @var string The seeder class name.
     */
    private string $seeder;

    private function __construct(
        private string $class,
        private ?string $namespace_class,
        private ?string $dist = null
    ) {
        if (is_null($dist)) {
            $this->dist = Path::model();
        }

        $this->stub = file_get_contents(Path::stub().'Model.stub');

        $this->seeder = $this->class;
    }

    /**
     * {@inheritDoc}
     */
    public function run(): void
    {
        $seederClass = str_replace(
            ['{model}'],
            [$this->class],
            $this->stub
        );

        file_put_contents(
            $this->dist.$this->seeder.'.php',
            $seederClass
        );
    }

    /**
     * Factory method.
     *
     * @param  string  $class  The model class name
     * @param  string  $namespace  The model namespace
     * @param  string  $dist  The path to the dist folder
     *
     * @example \Generators\ModelGenerator::make('User')
     * @example \Generators\ModelGenerator::make('User', 'App\Models')
     * @example \Generators\ModelGenerator::make('User', 'App\Models', 'dist/app/Models')
     */
    public static function make(
        string|Table $class,
        ?string $namespace = null,
        ?string $dist = null
    ): static {

        if ($class instanceof Table) {
            $class = Inflector::classify($class->name);
        }

        return new self($class, $namespace, $dist);
    }
}
