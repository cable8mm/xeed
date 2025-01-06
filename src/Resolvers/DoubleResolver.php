<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Support\Inflector;
use Cable8mm\Xeed\Types\Bracket;

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
        $bracket = Bracket::of($this->column->bracket)->escape();

        $bracket = empty($bracket) ? '' : ', '.$bracket;

        $migration = '$table->double(\''.$this->column->field.'\''.$bracket.')';

        return $this->last($migration);
    }

    public function nova(): ?string
    {
        return 'Number::make(\''.Inflector::title($this->column->field).'\')->step(\'any\'),';
    }

    public function cast(): ?string
    {
        return 'double';
    }
}
