<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Support\Inflector;

/**
 * JSON
 */
class JsonResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => json_encode(fake()->words()),';
    }

    public function migration(): string
    {
        $migration = '$table->json(\''.$this->column->field.'\')';

        return $this->last($migration);
    }

    public function nova(): ?string
    {
        return 'KeyValue::make(\''.Inflector::title($this->column->field).'\')->rules(\'json\'),';
    }

    public function cast(): ?string
    {
        return 'object';
    }
}
