<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Support\Inflector;

/**
 * REMEMBERTOKEN
 */
class RemembertokenResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->sha256(),';
    }

    public function migration(): string
    {
        return '$table->rememberToken();';
    }

    public function nova(): ?string
    {
        return 'Textarea::make(\''.Inflector::title($this->column->field).'\'),';
    }
}
