<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * TIME(fsp)
 *
 * A time.
 * Format: hh:mm:ss.
 * The supported range is from '-838:59:59' to '838:59:59'
 */
class TimeResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->time(),';
    }

    public function migration(): string
    {
        // TODO: $table->timeTz('sunrise', $precision = 0);
        $migration = '$table->time(\''.$this->column->field.'\', '.$this->column->bracket.')';

        return $this->last($migration);
    }
}
