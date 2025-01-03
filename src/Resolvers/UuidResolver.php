<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Support\Inflector;

/**
 * UUID
 */
class UuidResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->regexify(\'[a-zA-Z0-9]{36}\'),';
    }

    public function migration(): string
    {
        if (preg_match('/_uuid$/', $this->column->field)) {
            $migration = '$table->foreignUuid(\''.$this->column->field.'\')';
        } else {
            $migration = '$table->uuid(\''.$this->column->field.'\')';
        }

        return $this->last($migration);
    }

    public function nova(): ?string
    {
        return 'Text::make(\''.Inflector::title($this->column->field).'\'),';
    }
}
