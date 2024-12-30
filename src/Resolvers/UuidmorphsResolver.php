<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * UUIDMORPHS
 */
class UuidmorphsResolver extends Resolver
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

    public function nova(): ?string
    {
        return false;
    }
}
