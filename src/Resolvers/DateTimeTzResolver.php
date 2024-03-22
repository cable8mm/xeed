<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * timestamp with time zone
 *
 * PostgreSQL-specific date and time with time zone.
 */
class DateTimeTzResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->dateTime(),';
    }

    public function migration(): string
    {
        $migration = '$table->dateTimeTz(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
