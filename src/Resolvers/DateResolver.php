<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Support\Inflector;

/**
 * DATE
 *
 * A date. Format: YYYY-MM-DD.
 * The supported range is from '1000-01-01' to '9999-12-31'
 */
class DateResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->date(),';
    }

    public function migration(): string
    {
        $migration = '$table->date(\''.$this->column->field.'\')';

        return $this->last($migration);
    }

    public function nova(): ?string
    {
        return 'Date::make(\''.Inflector::title($this->column->field).'\'),';
    }

    public function cast(): ?string
    {
        return 'date';
    }
}
