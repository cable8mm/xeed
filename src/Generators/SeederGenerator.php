<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\GeneratorInterface;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;

/**
 * Generator for `dist/database/seeders/*.php`.
 */
final class SeederGenerator implements GeneratorInterface
{
    /**
     * @var string Stub string from the stubs folder file.
     */
    private string $stub;

    private function __construct(
        private Table $table,
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
    }

    /**
     * {@inheritDoc}
     */
    public function run(): void
    {
        $seederClass = str_replace(
            ['{class}', '{namespace_class}'],
            [$this->table->model('Seeder'), $this->namespace.'\\'.$this->table->model()],
            $this->stub
        );

        file_put_contents(
            $this->dist.$this->table->model().'Seeder.php',
            $seederClass
        );
    }

    /**
     * Factory method.
     *
     * @param  string|Table  $table  The model class name
     * @param  string  $namespace  The model namespace
     * @param  string  $dist  The path to the dist folder
     */
    public static function make(
        Table $table,
        ?string $namespace = null,
        ?string $dist = null
    ): static {
        return new self($table, $namespace, $dist);
    }
}
