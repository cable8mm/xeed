<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Support\Inflector;
use Cable8mm\Xeed\Types\Bracket;

/**
 * time with time zone
 *
 * Postgresql-specific time type.
 */
class TimeTzResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->time(),';
    }

    public function migration(): string
    {
        $bracket = Bracket::of($this->column->bracket)->to(0);

        $migration = '$table->timeTz(\''.$this->column->field.'\', '.$bracket.')';

        return $this->last($migration);
    }

    public function nova(): ?string
    {
        return 'DateTime::make(\''.Inflector::title($this->column->field).'\'),';
    }
}
