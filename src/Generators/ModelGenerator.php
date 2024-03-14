<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\Generator;
use Cable8mm\Xeed\Support\Path;

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
     */
    public static function make(
        string $class,
        ?string $namespace = null,
        ?string $dist = null
    ): static {
        return new self($class, $namespace, $dist);
    }
}
