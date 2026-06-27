<?php

namespace Cable8mm\Xeed\Generators;

use Cable8mm\Xeed\Interfaces\GeneratorInterface;
use Cable8mm\Xeed\Support\Path;
use Cable8mm\Xeed\Table;

/**
 * Generator for `dist/database/migrations/*.php`.
 */
final class RelationGenerator extends Generator implements GeneratorInterface
{
    private function __construct(Table $table, ?string $namespace = null, ?string $destination = null)
    {
        parent::__construct($table, $namespace, $destination);
        $this->defaultDestination(Path::model());
    }

    /**
     * {@inheritDoc}
     */
    public function run(bool $force = false): void
    {
        $model = $this->read($this->destination.DIRECTORY_SEPARATOR.$this->table->model().'.php');
        [$before, $after] = explode('use HasFactory;', $model);
        $belongsToRelation = '';

        foreach ($this->table->getForeignKeys() as $key) {
            $belongsTo = $key->belongsTo();
            $belongsToRelation .= $belongsTo;
            $relatedModel = $this->read($this->destination.DIRECTORY_SEPARATOR.$key->referenced_table.'.php');
            [$relatedBefore, $relatedAfter] = explode('use HasFactory;', $relatedModel);

            $hasManyRelation = $key->hasMany();
            $relatedModel = $relatedBefore.'use HasFactory;'.PHP_EOL.PHP_EOL.$hasManyRelation.$relatedAfter;
            $this->write($key->referenced_table.'.php', $relatedModel, $force);
        }

        $model = $before.'use HasFactory;'.(
            empty($belongsToRelation)
            ? ''
            : PHP_EOL.PHP_EOL.$belongsToRelation
        ).$after;

        $this->write($this->table->model().'.php', $model, $force);
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
