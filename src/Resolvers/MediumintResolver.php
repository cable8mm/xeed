<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * MEDIUMINT(size)
 *
 * A medium integer.
 * Signed range is from -8388608 to 8388607.
 * Unsigned range is from 0 to 16777215.
 * The size parameter specifies the maximum display width (which is 255)
 */
final class MediumintResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->randomNumber(),';
    }

    public function migration(): string
    {
        // TODO: $table->mediumIncrements('id');
        // TODO: $table->unsignedMediumInteger('votes');

        $migration = $this->column->unsigned ?
            '$table->unsignedMediumInteger(\''.$this->column->field.'\')' :
            '$table->mediumInteger(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
