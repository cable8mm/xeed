<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * BIGINT(size)
 *
 * A large integer.
 * Signed range is from -9223372036854775808 to 9223372036854775807.
 * Unsigned range is from 0 to 18446744073709551615.
 * The size parameter specifies the maximum display width (which is 255)
 */
class BigintResolver extends Resolver implements ResolverInterface
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->numerify(),';
    }

    public function migration(): string
    {
        // TODO: bigIncrements()
        // TODO: $table->foreignId('user_id');
        // TODO: $table->foreignIdFor(User::class);
        $migration = $this->column->unsigned ?
            '$table->unsignedBigInteger(\''.$this->column->field.'\')' :
            '$table->bigInteger(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
