<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\GeneratorInterface;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;

/**
 * Generator for `dist/database/migrations/*.php`.
 */
final class NovaResourceGenerator implements GeneratorInterface
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
        private Table $table,
        private ?string $namespace = null,
        private ?string $destination = null
    ) {
        if (is_null($destination)) {
            $this->destination = Path::nova();
        }

        $this->stub = File::system()->read(Path::stub().DIRECTORY_SEPARATOR.'NovaResource.stub');
    }

    /**
     * {@inheritDoc}
     */
    public function run(bool $force = false): void
    {
        $novaFieldsString = '';
        foreach ($this->table->getColumns() as $column) {
            $novaFieldsString .= self::INTENT.$column->novaField().PHP_EOL;
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

        $seederClass = str_replace(
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
            ],
            $this->stub
        );

        File::system()->write(
            $this->destination.DIRECTORY_SEPARATOR.$this->table->nova('.php'),
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
