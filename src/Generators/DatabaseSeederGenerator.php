<?php

namespace Cable8mm\Xeed\Generators;

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

    public const intent = '            ';

    private function __construct(
        private array $tables,
        private ?string $namespace = null,
        private ?string $dist = null
    ) {
        if (is_null($dist)) {
            $this->dist = Path::seeder();
        }

        if (is_null($namespace)) {
            $this->namespace = '\App\Models';
        }

        $this->stub = file_get_contents(Path::stub().'DatabaseSeeder.stub');
    }

    /**
     * To run the generator logic and save it to a file.
     */
    public function run(): void
    {
        $seeder_classes = '';

        foreach ($this->tables as $table) {
            $seeder_classes .= DatabaseSeederGenerator::intent.$table->model().'Seeder::class,'.PHP_EOL;
        }

        $seeder_classes = preg_replace('/\n$/', '', $seeder_classes);

        $seederClass = str_replace(
            ['{seeder_classes}'],
            [$seeder_classes],
            $this->stub
        );

        file_put_contents(
            $this->dist.'DatabaseSeeder.php',
            $seederClass
        );
    }

    /**
     * Factory method.
     *
     * @param  array<Table>  $tables  The model class name
     * @param  string  $namespace  The model namespace
     * @param  string  $dist  The path to the dist folder
     */
    public static function make(
        array $tables,
        ?string $namespace = null,
        ?string $dist = null
    ): static {
        return new self($tables, $namespace, $dist);
    }
}
