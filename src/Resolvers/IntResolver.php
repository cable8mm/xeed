<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * INT(size)
 *
 * A medium integer.
 * Signed range is from -2147483648 to 2147483647.
 * Unsigned range is from 0 to 4294967295.
 * The size parameter specifies the maximum display width (which is 255)
 */
class IntResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->randomNumber(),';
    }

    public function migration(): string
    {
        // TODO: $table->increments('id');
        $migration = $this->column->unsigned ?
            '$table->unsignedInteger(\''.$this->column->field.'\')' :
            '$table->integer(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
