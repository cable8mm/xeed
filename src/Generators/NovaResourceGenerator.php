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
    private const INTENT = '            ';

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
        $novaFieldsString = '';
        foreach ($this->table->getColumns() as $column) {
            if (! in_array($column->field, ['created_at', 'updated_at'])) {
                $novaFieldsString .= self::INTENT.$column->novaField().PHP_EOL;
            }
        }
        $novaFieldsString = rtrim($novaFieldsString, PHP_EOL.PHP_EOL);

        preg_match_all('/([a-zA-Z]+):/m', $novaFieldsString, $classUses);
        $uniqueClassUses = array_unique($classUses[1]);
        asort($uniqueClassUses);

        $classUsesString = '';
        foreach ($uniqueClassUses as $classUse) {
            $classUsesString .= 'use Laravel\\Nova\\Fields\\'.$classUse.';'.PHP_EOL;
        }
        $classUsesString = rtrim($classUsesString, PHP_EOL);

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
                    $classUsesString,
                    $this->table->nova(),
                    $this->table->model(),
                    $this->table->title(),
                    $novaFieldsString,
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
