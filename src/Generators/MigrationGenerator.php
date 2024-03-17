<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\GeneratorInterface;
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
            $fields .= '            '.$column->migration().PHP_EOL;
        }

        $fields = preg_replace('/\n$/', '', $fields);

        $seederClass = str_replace(
            ['{table}', '{fields}'],
            [$this->table, $fields],
            $this->stub
        );

        // 2019_12_14_000001_create_personal_access_tokens_table.php
        file_put_contents(
            $this->dist.$this->table->migration(),
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
