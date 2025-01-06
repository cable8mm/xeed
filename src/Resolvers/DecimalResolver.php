<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Support\Inflector;
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
        $bracket = Bracket::of($this->column->bracket)->escape();

        if (empty($bracket)) {
            return '\''.$this->column->field.'\' => fake()->randomFloat(),';
        }

        preg_match('/([0-9]+), ?([0-9]+)/', $bracket, $arguments);

        return '\''.$this->column->field.'\' => fake()->randomFloat('.$arguments[2].', 0, '.(pow(10, $arguments[1] - $arguments[2]) - 1).'),';
    }

    public function migration(): string
    {
        $bracket = Bracket::of($this->column->bracket)->escape();

        $bracket = empty($bracket) ? '' : ', '.$bracket;

        $migration = '$table->decimal(\''.$this->column->field.'\''.$bracket.')';

        return $this->last($migration);
    }

    public function nova(): ?string
    {
        return 'Number::make(\''.Inflector::title($this->column->field).'\')->step(\'any\'),';
    }

    public function cast(): ?string
    {
        return 'decimal:'.Bracket::of($this->column->bracket)->escape();
    }
}
