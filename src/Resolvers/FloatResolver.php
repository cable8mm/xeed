<?php

namespace Cable8mm\Xeed\Resolvers;

use PDOException;

/**
 * FLOAT(size, d)
 *
 * A floating point number.
 * The total number of digits is specified in size.
 * The number of digits after the decimal point is specified in the d parameter.
 * This syntax is deprecated in MySQL 8.0.17, and it will be removed in future MySQL versions
 *
 * FLOAT(p)
 *
 * A floating point number.
 * MySQL uses the p value to determine whether to use FLOAT or DOUBLE for the resulting data type.
 * If p is from 0 to 24, the data type becomes FLOAT().
 * If p is from 25 to 53, the data type becomes DOUBLE()
 */
class FloatResolver extends Resolver
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

            $migration = '$table->float(\''.$this->column->field.'\', '.$length.', '.$decimals.')';
        } else {
            $migration = '$table->float(\''.$this->column->field.'\')';
        }

        return $this->last($migration);
    }
}
