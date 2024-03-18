<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * BIGINT(size)
 *
 * A large integer.
 * Signed range is from -9223372036854775808 to 9223372036854775807.
 * Unsigned range is from 0 to 18446744073709551615.
 * The size parameter specifies the maximum display width (which is 255)
 */
class BigintResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->numerify(),';
    }

    public function migration(): string
    {
        // TODO: bigIncrements()
        if ($this->column->unsigned && preg_match('/_id$/', $this->column->field)) {
            $migration = '$table->foreignId(\''.$this->column->field.'\')';
        } else {
            $migration = $this->column->unsigned ?
            '$table->unsignedBigInteger(\''.$this->column->field.'\')' :
            '$table->bigInteger(\''.$this->column->field.'\')';
        }

        return $this->last($migration);
    }
}
