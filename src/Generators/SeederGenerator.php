<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\Generator;
use Cable8mm\Xeed\Path;
use Cable8mm\Xeed\Traits\SeederGeneratorMakable;

final class SeederGenerator implements Generator
{
    use SeederGeneratorMakable;

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
        private ?string $namespace = null,
        private ?string $dist = null
    ) {
        if (is_null($dist)) {
            $this->dist = Path::seeder();
        }

        if (is_null($namespace)) {
            $this->namespace = '\App\Models';
        }

        $this->stub = file_get_contents(Path::stub().'Seeder.stub');

        $this->seeder = $this->class.'Seeder';
    }

    public function run(): void
    {
        $seederClass = str_replace(
            ['{class}', '{namespace_class}'],
            [$this->class, $this->namespace.'\\'.$this->class],
            $this->stub
        );

        file_put_contents(
            $this->dist.$this->seeder.'.php',
            $seederClass
        );
    }
}
