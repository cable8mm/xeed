<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\GeneratorInterface;
use Cable8mm\Xeed\Mergers\Merger;
use Cable8mm\Xeed\Mergers\MergerContainer;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;

/**
 * Generator for `dist/database/migrations/*.php`.
 */
final class MigrationGenerator extends Generator implements GeneratorInterface
{
    /**
     * The left padding for the body of the generated.
     */
    public const INTENT = '            ';

    /**
     * Engines for MergerContainer.
     *
     * @var ?array<Merger>
     */
    private ?array $mergerEngines = null;

    private function __construct(Table $table, ?string $namespace = null, ?string $destination = null)
    {
        parent::__construct($table, $namespace, $destination);
        $this->defaultDestination(Path::migration());
        $this->loadStub('Migration.stub');
    }

    /**
     * {@inheritDoc}
     */
    public function run(bool $force = false): void
    {
        $fields = '';

        foreach ($this->table->getColumns() as $column) {
            $fields .= MigrationGenerator::INTENT.$column->migration().PHP_EOL;
        }

        $fields = preg_replace('/\n$/', '', $fields);

        $migration = $this->replace(['{table}', '{fields}'], [$this->table, $fields]);

        if (! is_null($this->mergerEngines)) {
            $migration = MergerContainer::from(body : $migration)
                ->engines($this->mergerEngines)
                ->operating()
                ->verbose();
        }

        $this->write($this->table->migration(), $migration, $force);
    }

    /**
     * Set merger engines.
     *
     * @param  array<Merger>  $engines  An array of merger engines.
     * @return static The method returns the current instance that enables methods chaining.
     */
    public function merging(array $engines): static
    {
        $this->mergerEngines = $engines;

        return $this;
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
