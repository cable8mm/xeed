<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\GeneratorInterface;
use Cable8mm\Xeed\Mergers\MergerContainer;
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

    public const intent = '            ';

    /**
     * Engines for MergerContainer.
     *
     * @var ?array<Merger>
     */
    private ?array $mergerEngines = null;

    private function __construct(
        private Table $table,
        private ?string $namespace = null,
        private ?string $dist = null
    ) {
        if (is_null($dist)) {
            $this->dist = Path::migration();
        }

        $this->stub = file_get_contents(Path::stub().'Migration.stub');
    }

    /**
     * {@inheritDoc}
     */
    public function run(): void
    {
        $fields = '';

        foreach ($this->table->getColumns() as $column) {
            $fields .= MigrationGenerator::intent.$column->migration().PHP_EOL;
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

        file_put_contents(
            $this->dist.$this->table->migration(),
            $seederClass
        );
    }

    /**
     * To set merger engines.
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
