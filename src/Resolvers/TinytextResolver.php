<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Support\Inflector;

/**
 * TINYTEXT
 *
 * Holds a string with a maximum length of 255 characters
 */
class TinytextResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->text(255),';
    }

    public function migration(): string
    {
        $migration = '$table->tinyText(\''.$this->column->field.'\')';

        return $this->last($migration);
    }

    public function nova(): ?string
    {
        return 'Text::make(\''.Inflector::title($this->column->field).'\')->maxlength(255),';
    }
}
