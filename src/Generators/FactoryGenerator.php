<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\GeneratorInterface;
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

    private function __construct(
        private Table $table,
        private ?string $namespace = null,
        private ?string $dist = null
    ) {
        if (is_null($dist)) {
            $this->dist = Path::factory();
        }

        $this->stub = file_get_contents(Path::stub().'Factory.stub');
    }

    /**
     * {@inheritDoc}
     */
    public function run(): void
    {
        $fakers = '';

        foreach ($this->table->getColumns() as $column) {
            $fakers .= '            '.$column->fake().PHP_EOL;
        }

        $fakers = preg_replace('/\n$/', '', $fakers);

        $seederClass = str_replace(
            ['{model}', '{fakers}'],
            [$this->table->model(), $fakers],
            $this->stub
        );

        file_put_contents(
            $this->dist.$this->table->model().'Factory.php',
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
