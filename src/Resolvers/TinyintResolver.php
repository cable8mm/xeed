<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * TINYINT(size)
 *
 * A very small integer.
 * Signed range is from -128 to 127.
 * Unsigned range is from 0 to 255.
 * The size parameter specifies the maximum display width (which is 255)
 */
final class TinyintResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->numberBetween(0, 127),';
    }

    public function migration(): string
    {
        // TODO: $table->tinyIncrements('id');
        // TODO: $table->unsignedTinyInteger('votes');
        $migration = '$table->tinyInteger(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
