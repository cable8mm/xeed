<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\GeneratorInterface;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;

/**
 * Generator for `dist/database/factories/*.php`.
 */
final class FactoryGenerator implements GeneratorInterface
{
    /**
     * @var string Stub string from the stubs folder file.
     */
    private string $stub;

    public const intent = '            ';

    private function __construct(
        private Table $table,
        private ?string $namespace = null,
        private ?string $destination = null
    ) {
        if (is_null($destination)) {
            $this->destination = Path::factory();
        }

        $this->stub = File::system()->read(Path::stub().'Factory.stub');
    }

    /**
     * {@inheritDoc}
     */
    public function run(bool $force = false): void
    {
        $fakers = '';

        foreach ($this->table->getColumns() as $column) {
            $fakers .= FactoryGenerator::intent.$column->fake().PHP_EOL;
        }

        $fakers = preg_replace('/\n$/', '', $fakers);

        $seederClass = str_replace(
            ['{model}', '{fakers}'],
            [$this->table->model(), $fakers],
            $this->stub
        );

        File::system()->write(
            $this->destination.$this->table->model().'Factory.php',
            $seederClass,
            $force
        );
    }

    /**
     * Factory method.
     *
     * @param  string|Table  $table  The model class name
     * @param  string  $namespace  The model namespace
     * @param  string  $destination  The path to the dist folder
     */
    public static function make(
        Table $table,
        ?string $namespace = null,
        ?string $destination = null
    ): static {
        return new self($table, $namespace, $destination);
    }
}
