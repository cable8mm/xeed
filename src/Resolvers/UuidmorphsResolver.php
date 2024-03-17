<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * UUIDMORPHS
 */
class UuidmorphsResolver extends Resolver implements ResolverInterface
{
    public function fake(): string
    {
        // TODO: implement this method for uuid morphs
        return '';
    }

    public function migration(): string
    {
        $migration = '$table->uuidMorphs(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
