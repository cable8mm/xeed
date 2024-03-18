<?php

namespace Cable8mm\Xeed\Resolvers;

use PDOException;

/**
 * DOUBLE(size, d)
 *
 * A normal-size floating point number.
 * The total number of digits is specified in size.
 * The number of digits after the decimal point is specified in the d parameter
 */
class DoubleResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->randomFloat(),';
    }

    /**
     * {@inheritDoc}
     *
     * @exception \PDOException
     */
    public function migration(): string
    {
        if ($this->column->bracket) {
            if (! preg_match('/\d+,\d+/', $this->column->bracket)) {
                throw new PDOException($this->column->bracket.' have not a length and a decimals.');
            }

            [$length, $decimals] = explode(',', $this->column->bracket);

            $migration = '$table->double(\''.$this->column->field.'\', '.$length.', '.$decimals.')';
        } else {
            $migration = '$table->double(\''.$this->column->field.'\')';
        }

        return $this->last($migration);
    }
}
