<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Support\Inflector;

/**
 * BINARY(size)
 *
 * Equal to CHAR(), but stores binary byte strings.
 * The size parameter specifies the column length in bytes.
 * Default is 1
 */
class BinaryResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->sha1(),';
    }

    public function migration(): string
    {
        $migration = '$table->binary(\''.$this->column->field.'\')';

        return $this->last($migration);
    }

    public function nova(): ?string
    {
        return 'Text::make(\''.Inflector::title($this->column->field).'\'),';
    }
}
