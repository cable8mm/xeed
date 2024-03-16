<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * SMALLINT(size)
 *
 * A small integer.
 * Signed range is from -32768 to 32767.
 * Unsigned range is from 0 to 65535.
 * The size parameter specifies the maximum display width (which is 255)
 */
final class SmallintResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->numberBetween(0, 32767),';
    }

    public function migration(): string
    {
        // TODO: $table->smallIncrements('id');
        $migration = $this->column->unsigned ?
            '$table->unsignedSmallInteger(\''.$this->column->field.'\')' :
            '$table->smallInteger(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
