<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Support\Inflector;

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

    public function nova(): ?string
    {
        return 'DateTime::make(\''.Inflector::title($this->column->field).'\'),';
    }

    public function cast(): ?string
    {
        return 'datetime';
    }
}
