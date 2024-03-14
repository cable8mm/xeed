<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * MULTIPOINT
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
        $migration = '$table->multiPoint(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
