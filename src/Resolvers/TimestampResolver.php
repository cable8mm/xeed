<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * TIMESTAMP(fsp)
 *
 * A timestamp.
 * TIMESTAMP values are stored as the number of seconds since the Unix epoch ('1970-01-01 00:00:00' UTC).
 * Format: YYYY-MM-DD hh:mm:ss.
 * The supported range is from '1970-01-01 00:00:01' UTC to '2038-01-09 03:14:07' UTC.
 * Automatic initialization and updating to the current date and time can be specified using DEFAULT CURRENT_TIMESTAMP and ON UPDATE CURRENT_TIMESTAMP in the column definition
 */
class TimestampResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->unixTime(),';
    }

    public function migration(): string
    {
        // TODO: $table->nullableTimestamps(0);
        // The nullableTimestamps method is an alias of the timestamps method:
        // @see https://laravel.com/docs/10.x/migrations#column-method-nullableTimestamps
        //
        // TODO: $table->softDeletesTz($column = 'deleted_at', $precision = 0);
        // TODO: $table->softDeletes($column = 'deleted_at', $precision = 0);
        // TODO: $table->timestampTz('added_at', $precision = 0);
        // TODO: $table->timestampsTz($precision = 0);
        // TODO: $table->timestamps($precision = 0);
        $migration = empty($this->column->bracket) ?
            '$table->timestamp(\''.$this->column->field.'\')' :
            '$table->timestamp(\''.$this->column->field.'\', '.$this->column->bracket.')';

        return $this->last($migration);
    }
}
