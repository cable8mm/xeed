<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * POINT
 */
class PointResolver extends Resolver
{
    public function fake(): string
    {
        // TODO: Implement fake() method.
        return '\''.$this->column->field.'\' => \'POINT(10 10)\',';
    }

    public function migration(): string
    {
        $migration = '$table->point(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
