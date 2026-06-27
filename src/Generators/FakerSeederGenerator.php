<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\GeneratorInterface;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;

/**
 * Generator for `dist/database/seeders/*.php`.
 */
final class FakerSeederGenerator extends Generator implements GeneratorInterface
{
    /**
     * The left padding for the body of the generated.
     */
    private const INDENT = '                ';

    private const SUB_INDENT = '            ';

    private int $count = 10;

    private function __construct(Table $table, ?string $namespace = null, ?string $destination = null)
    {
        parent::__construct($table, $namespace, $destination);
        $this->defaultDestination(Path::seeder());
        $this->defaultNamespace('\App\Models');

        $this->loadStub('FakerSeeder.stub');
    }

    /**
     * Set count values for the generated stub
     */
    public function count(int $count): static
    {
        $this->count = $count;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function run(bool $force = false): void
    {
        $record = self::SUB_INDENT.'$records[] = ['.PHP_EOL;

        foreach ($this->table->getColumns() as $column) {
            $record .= self::INDENT.$column->fake().PHP_EOL;
        }

        $record = preg_replace('/\n$/', '', $record).PHP_EOL.self::SUB_INDENT.'];';

        $this->write(
            $this->table->seeder('.php'),
            $this->replace(
                ['{class}', '{records}', '{table_name}', '{count}'],
                [$this->table->model('Seeder'), $record, $this->table, $this->count]
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
