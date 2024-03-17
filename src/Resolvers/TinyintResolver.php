<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * TINYINT(size)
 *
 * A very small integer.
 * Signed range is from -128 to 127.
 * Unsigned range is from 0 to 255.
 * The size parameter specifies the maximum display width (which is 255)
 */
final class TinyintResolver extends Resolver implements ResolverInterface
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->numberBetween(0, 127),';
    }

    public function migration(): string
    {
        if ($this->column->field == 'id' && $this->column->autoIncrement) {
            $migration = '$table->tinyIncrements(\''.$this->column->field.'\')';
        } else {
            $migration = $this->column->unsigned ?
                '$table->unsignedTinyInteger(\''.$this->column->field.'\')' :
                '$table->tinyInteger(\''.$this->column->field.'\')';
        }

        return $this->last($migration);
    }
}
