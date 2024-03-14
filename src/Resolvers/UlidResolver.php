<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * ULID
 */
class UlidResolver extends Resolver
{
    public function fake(): string
    {
        // TODO: implement this method for ulid
        return '';
    }

    public function migration(): string
    {
        $migration = '$table->ulid(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
