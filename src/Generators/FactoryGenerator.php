<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\GeneratorInterface;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;

/**
 * Generator for `dist/database/factories/*.php`.
 */
final class FactoryGenerator extends Generator implements GeneratorInterface
{
    /**
     * The left padding for the body of the generated.
     */
    private const INTENT = '            ';

    private function __construct(Table $table, ?string $namespace = null, ?string $destination = null)
    {
        parent::__construct($table, $namespace, $destination);
        $this->defaultDestination(Path::factory());
        $this->loadStub('Factory.stub');
    }

    /**
     * {@inheritDoc}
     */
    public function run(bool $force = false): void
    {
        $fakers = '';

        foreach ($this->table->getColumns() as $column) {
            if (! empty($column->fake())) {
                $fakers .= FactoryGenerator::INTENT.$column->fake().PHP_EOL;
            }
        }

        $fakers = preg_replace('/\n$/', '', $fakers);

        $this->write(
            $this->table->model().'Factory.php',
            $this->replace(['{model}', '{fakers}'], [$this->table->model(), $fakers]),
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
