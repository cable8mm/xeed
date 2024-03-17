<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * ULIDMORPHS
 */
class UlidmorphsResolver extends Resolver implements ResolverInterface
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
