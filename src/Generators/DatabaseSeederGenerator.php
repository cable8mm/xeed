<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;

/**
 * Generator for `dist/database/seeders/DatabaseSeeder.php`.
 */
final class DatabaseSeederGenerator
{
    /**
     * @var string Stub string from the stubs folder file.
     */
    private string $stub;

    /**
     * The left padding for the body of the generated.
     */
    public const INTENT = '            ';

    private function __construct(
        private array $tables,
        private ?string $namespace = null,
        private ?string $destination = null
    ) {
        if (is_null($destination)) {
            $this->destination = Path::seeder();
        }

        if (is_null($namespace)) {
            $this->namespace = '\App\Models';
        }

        $this->stub = File::system()->read(Path::stub().DIRECTORY_SEPARATOR.'DatabaseSeeder.stub');
    }

    /**
     * Run the generator logic and save it.
     */
    public function run(bool $force = false): void
    {
        $seeder_classes = '';

        foreach ($this->tables as $table) {
            $seeder_classes .= DatabaseSeederGenerator::INTENT.$table->model().DIRECTORY_SEPARATOR.'Seeder::class,'.PHP_EOL;
        }

        $seeder_classes = preg_replace('/\n$/', '', $seeder_classes);

        $seederClass = str_replace(
            ['{seeder_classes}'],
            [$seeder_classes],
            $this->stub
        );

        File::system()->write(
            $this->destination.DIRECTORY_SEPARATOR.'DatabaseSeeder.php',
            $seederClass,
            $force
        );
    }

    /**
     * Create a instance.
     *
     * @param  array<\Cable8mm\Xeed\Table>  $tables  The model class name
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
