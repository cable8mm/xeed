<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * MULTIPOINT
 */
class MultipointResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => \'MULTIPOINT(0 0, 20 20, 60 60)\',';
    }

    public function migration(): string
    {
        $migration = '$table->multiPoint(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
