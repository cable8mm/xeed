<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * MORPHS
 *
 * The morphs method is a convenience method that adds a {column}_id equivalent column and a {column}_type VARCHAR equivalent column.
 * The column type for the {column}_id will be UNSIGNED BIGINT, CHAR(36), or CHAR(26) depending on the model key type.
 *
 * @see https://laravel.com/docs/10.x/migrations#column-method-morphs
 */
class MorphsResolver extends Resolver
{
    public function fake(): string
    {
        // TODO: Implement fake() method.
        return '';
    }

    public function migration(): string
    {
        // TODO: $table->nullableMorphs('taggable');
        $migration = '$table->morphs(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
