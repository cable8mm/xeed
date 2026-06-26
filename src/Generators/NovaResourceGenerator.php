<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\GeneratorInterface;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;

/**
 * Generator for `dist/database/migrations/*.php`.
 */
final class NovaResourceGenerator extends Generator implements GeneratorInterface
{
    /**
     * The left padding for the body of the generated.
     */
    private const INDENT = '            ';

    private function __construct(Table $table, ?string $namespace = null, ?string $destination = null)
    {
        parent::__construct($table, $namespace, $destination);
        $this->defaultDestination(Path::nova());
        $this->loadStub('NovaResource.stub');
    }

    /**
     * {@inheritDoc}
     */
    public function run(bool $force = false): void
    {
        $novaFieldLines = '';
        foreach ($this->table->getColumns() as $column) {
            if (! in_array($column->field, ['created_at', 'updated_at'])) {
                $novaFieldLines .= self::INDENT.$column->novaField().PHP_EOL;
            }
        }
        $novaFieldLines = rtrim($novaFieldLines, PHP_EOL.PHP_EOL);

        preg_match_all('/([a-zA-Z]+):/m', $novaFieldLines, $fieldMatches);
        $uniqueFieldNames = array_unique($fieldMatches[1]);
        asort($uniqueFieldNames);

        $fieldImports = '';
        foreach ($uniqueFieldNames as $fieldName) {
            $fieldImports .= 'use Laravel\\Nova\\Fields\\'.$fieldName.';'.PHP_EOL;
        }
        $fieldImports = rtrim($fieldImports, PHP_EOL);

        $this->write(
            $this->table->nova('.php'),
            $this->replace(
                [
                    '{class_uses}',
                    '{nova_class_name}',
                    '{model_class_name}',
                    '{table_title}',
                    '{nova_fields}',
                ],
                [
                    $fieldImports,
                    $this->table->nova(),
                    $this->table->model(),
                    $this->table->title(),
                    $novaFieldLines,
                ]
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
