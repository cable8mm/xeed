<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * DATE
 *
 * A date. Format: YYYY-MM-DD.
 * The supported range is from '1000-01-01' to '9999-12-31'
 */
class DateResolver extends Resolver implements ResolverInterface
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->date(),';
    }

    public function migration(): string
    {
        $migration = '$table->date(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
