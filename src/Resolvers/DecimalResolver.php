<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Types\Bracket;

/**
 * DECIMAL(size, d)
 *
 * An exact fixed-point number.
 * The total number of digits is specified in size.
 * The number of digits after the decimal point is specified in the d parameter.
 * The maximum number for size is 65.
 * The maximum number for d is 30.
 * The default value for size is 10.
 * The default value for d is 0.
 */
class DecimalResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->randomFloat(2, 0, 10000),';
    }

    public function migration(): string
    {
        // TODO: $table->unsignedDecimal('amount', $precision = 8, $scale = 2);
        $bracket = Bracket::of($this->column->bracket)->escape();

        $migration = $this->column->unsigned ?
            '$table->unsignedDecimal(\''.$this->column->field.'\', '.$bracket.')' :
            '$table->decimal(\''.$this->column->field.'\', '.$bracket.')';

        return $this->last($migration);
    }
}
