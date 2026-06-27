<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;

/**
 * Generator for `dist/database/seeders/DatabaseSeeder.php`.
 */
final class DatabaseSeederGenerator
{
    /**
     * The left padding for the body of the generated.
     */
    private const INDENT = '            ';

    /**
     * @var string Stub string from the stubs folder file.
     */
    private string $stub;

    private array $tables;

    private string $destination;

    private function __construct(array $tables, ?string $namespace = null, ?string $destination = null)
    {
        $this->tables = $tables;
        $this->destination = $destination ?? Path::seeder();
        unset($namespace);

        $this->stub = File::system()->read(Path::stub().DIRECTORY_SEPARATOR.'DatabaseSeeder.stub');
    }

    /**
     * Run the generator logic and save it.
     */
    public function run(bool $force = false): void
    {
        $seederClasses = '';

        foreach ($this->tables as $table) {
            $seederClasses .= DatabaseSeederGenerator::INDENT.$table->model().'Seeder::class,'.PHP_EOL;
        }

        $seederClasses = preg_replace('/\n$/', '', $seederClasses);

        File::system()->write(
            $this->destination.DIRECTORY_SEPARATOR.'DatabaseSeeder.php',
            str_replace(['{seeder_classes}'], [$seederClasses], $this->stub),
            $force
        );
    }

    /**
     * Create a instance.
     *
     * @param  array<Table>  $tables  The model class name
     * @param  string  $namespace  The model namespace
     * @param  string  $destination  The path to the dist folder
     */
    public static function make(
        array $tables,
        ?string $namespace = null,
        ?string $destination = null
    ): static {
        return new self($tables, $namespace, $destination);
    }
}
