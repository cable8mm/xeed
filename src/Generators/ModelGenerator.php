<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\GeneratorInterface;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;

/**
 * Generator for `dist/app/Models/*.php`.
 *
 * @throws Exception \League\Flysystem\FilesystemException
 * @throws Exception \League\Flysystem\UnableToReadFile
 */
final class ModelGenerator implements GeneratorInterface
{
    /**
     * @var string Stub string from the stubs folder file.
     */
    private string $stub;

    private function __construct(
        private Table $table,
        private ?string $namespace_class,
        private ?string $destination = null
    ) {
        if (is_null($destination)) {
            $this->destination = Path::model();
        }

        $this->stub = File::system()->read(Path::stub().DIRECTORY_SEPARATOR.'Model.stub');
    }

    /**
     * {@inheritDoc}
     */
    public function run(bool $force = false): void
    {
        // Check if having casts
        $casts = [];
        foreach ($this->table->getColumns() as $column) {
            if (! is_null($column->cast())) {
                $casts[] = "'{$column->field}' => '{$column->cast()}'";
            }
        }

        $castString = '';
        if (! empty($casts)) {
            $castString = PHP_EOL.PHP_EOL.'    '.'protected function casts(): array'.PHP_EOL.'    {'.PHP_EOL.'        return ['.PHP_EOL.'            ';
            $castString .= implode(','.PHP_EOL.'            ', $casts).PHP_EOL;
            $castString .= '        ];'.PHP_EOL.'    }';
        }

        $seederClass = str_replace(
            [
                '{model}',
                '{timestamps}',
                '{casts}',
            ],
            [
                $this->table->model(),
                $this->table->hasTimestamps() ? PHP_EOL.PHP_EOL.'    public $timestamps = false;' : '',
                $castString,
            ],
            $this->stub
        );

        File::system()->write(
            $this->destination.DIRECTORY_SEPARATOR.$this->table->model().'.php',
            $seederClass,
            $force
        );
    }

    /**
     * {@inheritDoc}
     *
     * @example \Generators\ModelGenerator::make('User')
     * @example \Generators\ModelGenerator::make('User', 'App\Models')
     * @example \Generators\ModelGenerator::make('User', 'App\Models', 'dist/app/Models')
     */
    public static function make(
        Table $table,
        ?string $namespace = null,
        ?string $destination = null
    ): static {
        return new self($table, $namespace, $destination);
    }
}
