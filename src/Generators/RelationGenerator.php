<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\GeneratorInterface;
use Cable8mm\Xeed\Support\File;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;

/**
 * Generator for `dist/database/migrations/*.php`.
 */
final class RelationGenerator implements GeneratorInterface
{
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
            $this->destination = Path::model();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function run(bool $force = false): void
    {
        $model = File::system()->read($this->destination.DIRECTORY_SEPARATOR.$this->table->model().'.php');
        [$before, $after] = explode('use HasFactory;', $model);
        $belongsToRelation = '';

        foreach ($this->table->getForeignKeys() as $key) {
            $belongsTo = $key->belongsTo();
            $belongsToRelation .= $belongsTo;
            $relatedModel = File::system()->read($this->destination.DIRECTORY_SEPARATOR.$key->referenced_table.'.php');
            [$relatedBefore, $relatedAfter] = explode('use HasFactory;', $relatedModel);

            $hasManyRelation = $key->hasMany();
            $relatedModel = $relatedBefore.'use HasFactory;'.PHP_EOL.PHP_EOL.$hasManyRelation.$relatedAfter;
            File::system()->write(
                $this->destination.DIRECTORY_SEPARATOR.$key->referenced_table.'.php',
                $relatedModel,
                true
            );
        }

        $model = $before.'use HasFactory;'.(
            empty($belongsToRelation)
            ? ''
            : PHP_EOL.PHP_EOL.$belongsToRelation
        ).$after;

        File::system()->write(
            $this->destination.DIRECTORY_SEPARATOR.$this->table->model().'.php',
            $model,
            true
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
