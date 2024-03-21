<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\GeneratorInterface;
use Cable8mm\Xeed\Mergers\MergerContainer;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;

/**
 * Generator for `dist/database/migrations/*.php`.
 */
final class MigrationGenerator implements GeneratorInterface
{
    /**
     * @var string Stub string from the stubs folder file.
     */
    private string $stub;

    /**
     * The left padding for the body of the generated.
     */
    public const INTENT = '            ';

    /**
     * Engines for MergerContainer.
     *
     * @var ?array<\Cable8mm\Xeed\Mergers\Merger>
     */
    private ?array $mergerEngines = null;

    private function __construct(
        private Table $table,
        private ?string $namespace = null,
        private ?string $destination = null
    ) {
        if (is_null($destination)) {
            $this->destination = Path::migration();
        }

        $this->stub = File::system()->read(Path::stub().DIRECTORY_SEPARATOR.'Migration.stub');
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

        $seederClass = str_replace(
            ['{table}', '{fields}'],
            [$this->table, $fields],
            $this->stub
        );

        if (! is_null($this->mergerEngines)) {
            $seederClass = MergerContainer::from(body : $seederClass)
                ->engines($this->mergerEngines)
                ->operating()
                ->verbose();
        }

        File::system()->write(
            $this->destination.DIRECTORY_SEPARATOR.$this->table->migration(),
            $seederClass,
            $force
        );
    }

    /**
     * Set merger engines.
     *
     * @param  array<\Cable8mm\Xeed\Mergers\Merger>  $engines  An array of merger engines.
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
