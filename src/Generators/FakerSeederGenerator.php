<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\GeneratorInterface;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;

/**
 * Generator for `dist/database/seeders/*.php`.
 */
final class FakerSeederGenerator implements GeneratorInterface
{
    /**
     * @var string Stub string from the stubs folder file.
     */
    private string $stub;

    /**
     * The left padding for the body of the generated.
     */
    const INTENT = '                ';

    const SUB_INTENT = '            ';

    private int $count = 10;

    private function __construct(
        private Table $table,
        private ?string $namespace = null,
        private ?string $destination = null
    ) {
        if (is_null($destination)) {
            $this->destination = Path::seeder();
        }

        if (is_null($namespace)) {
            $this->namespace = '\App\Models';
        }

        $this->stub = File::system()->read(Path::stub().DIRECTORY_SEPARATOR.'FakerSeeder.stub');
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
        $record = self::SUB_INTENT.'$records[] = ['.PHP_EOL;

        foreach ($this->table->getColumns() as $column) {
            $record .= self::INTENT.$column->fake().PHP_EOL;
        }

        $record = preg_replace('/\n$/', '', $record).PHP_EOL.self::SUB_INTENT.'];';

        $seederClass = str_replace(
            ['{class}', '{records}', '{table_name}', '{count}'],
            [$this->table->model('Seeder'), $record, $this->table, $this->count],
            $this->stub
        );

        File::system()->write(
            $this->destination.DIRECTORY_SEPARATOR.$this->table->seeder('.php'),
            $seederClass,
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
