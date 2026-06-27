<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\GeneratorInterface;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;

/**
 * Generator for `dist/database/seeders/*.php`.
 */
final class SeederGenerator extends Generator implements GeneratorInterface
{
    private function __construct(Table $table, ?string $namespace = null, ?string $destination = null)
    {
        parent::__construct($table, $namespace, $destination);
        $this->defaultDestination(Path::seeder());
        $this->defaultNamespace('\App\Models');

        $this->loadStub('Seeder.stub');
    }

    /**
     * {@inheritDoc}
     */
    public function run(bool $force = false): void
    {
        $this->write(
            $this->table->seeder('.php'),
            $this->replace(
                ['{class}', '{namespace_class}'],
                [$this->table->model('Seeder'), $this->qualifyModel($this->table->model())]
            ),
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
