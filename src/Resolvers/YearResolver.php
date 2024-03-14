<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * YEAR
 *
 * A year in four-digit format.
 * Values allowed in four-digit format: 1901 to 2155, and 0000.
 * MySQL 8.0 does not support year in two-digit format.
 */
class YearResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->year(),';
    }

    public function migration(): string
    {
        $migration = '$table->year(\''.$this->column->field.'\', '.$this->column->bracket.')';

        return $this->last($migration);
    }
}
