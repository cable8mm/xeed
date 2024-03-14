<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * ULIDMORPHS
 */
class UlidmorphsResolver extends Resolver
{
    public function fake(): string
    {
        // TODO: implement this method for ulid morphs
        return '';
    }

    public function migration(): string
    {
        $migration = '$table->ulidMorphs(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
