<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Support\Inflector;
use Cable8mm\Xeed\Types\Bracket;

/**
 * VARCHAR(size)
 *
 * A VARIABLE length string (can contain letters, numbers, and special characters).
 * The size parameter specifies the maximum column length in characters - can be from 0 to 65535
 */
class VarcharResolver extends Resolver
{
    public function fake(): string
    {
        $bracket = Bracket::of($this->column->bracket)->escape();

        $bracket = empty($bracket) ? '65535' : $bracket;

        return '\''.$this->column->field.'\' => fake()->text('.$bracket.'),';
    }

    public function migration(): string
    {
        $bracket = Bracket::of($this->column->bracket)->escape();

        $bracket = empty($bracket) ? '65535' : $bracket;

        $migration = '$table->string(\''.$this->column->field.'\', '.$bracket.')';

        return $this->last($migration);
    }

    public function nova(): ?string
    {
        $bracket = Bracket::of($this->column->bracket)->escape();

        $bracket = empty($bracket) ? '65535' : $bracket;

        return 'Text::make(\''.Inflector::title($this->column->field).'\')->maxlength('.$bracket.'),';
    }
}
