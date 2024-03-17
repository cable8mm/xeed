<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * MULTIPOINT
 */
class MultipointResolver extends Resolver implements ResolverInterface
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
