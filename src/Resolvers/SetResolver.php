<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Types\Bracket;

/**
 * SET(val1, val2, val3, ...)
 *
 * A string object that can have 0 or more values, chosen from a list of possible values.
 * You can list up to 64 values in a SET list
 */
class SetResolver extends Resolver
{
    public function fake(): string
    {
        // TODO: Replace 1,2,3 with real values
        return '\''.$this->column->field.'\' => fake()->randomElement([1,2,3]),';
    }

    public function migration(): string
    {
        $bracket = Bracket::of($this->column->bracket)->array();

        $migration = '$table->set(\''.$this->column->field.'\', '.$bracket.')';

        return $this->last($migration);
    }
}
