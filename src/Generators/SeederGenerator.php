<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\GeneratorInterface;
use Cable8mm\Xeed\Support\File;
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
        private ?string $destination = null
    ) {
        if (is_null($destination)) {
            $this->destination = Path::seeder();
        }

        if (is_null($namespace)) {
            $this->namespace = '\App\Models';
        }

        $this->stub = File::system()->read(Path::stub().DIRECTORY_SEPARATOR.'Seeder.stub');
    }

    /**
     * {@inheritDoc}
     */
    public function run(bool $force = false): void
    {
        $seederClass = str_replace(
            ['{class}', '{namespace_class}'],
            [$this->table->model('Seeder'), $this->namespace.'\\'.$this->table->model()],
            $this->stub
        );

        File::system()->write(
            $this->destination.DIRECTORY_SEPARATOR.$this->table->seeder('.php'),
            $seederClass,
            $force
        );
    }

    /**
     * {@inheritDoc}
     */
    public static function make(
        Table $table,
        ?string $namespace = null,
        ?string $destination = null
    ): static {
        return new self($table, $namespace, $destination);
    }
}
