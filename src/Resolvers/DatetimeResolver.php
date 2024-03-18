<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * DATETIME(fsp)
 *
 * A date and time combination.
 * Format: YYYY-MM-DD hh:mm:ss.
 * The supported range is from '1000-01-01 00:00:00' to '9999-12-31 23:59:59'.
 * Adding DEFAULT and ON UPDATE in the column definition to get automatic initialization and updating to the current date and time
 */
class DatetimeResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->dateTime(),';
    }

    public function migration(): string
    {
        // TODO: dateTimeTz
        $migration = '$table->dateTime(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
