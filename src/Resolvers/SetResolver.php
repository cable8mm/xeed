<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * SET(val1, val2, val3, ...)
 *
 * A string object that can have 0 or more values, chosen from a list of possible values.
 * You can list up to 64 values in a SET list
 */
class SetResolver extends Resolver implements ResolverInterface
{
    public function fake(): string
    {
        // TODO: Replace 1,2,3 with real values
        return '\''.$this->column->field.'\' => fake()->randomElement([1,2,3]),';
    }

    public function migration(): string
    {
        // TODO: $table->set('flavors', ['strawberry', 'vanilla']);
        $migration = '$table->set(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
