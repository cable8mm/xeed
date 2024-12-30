<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Support\Inflector;

/**
 * JSONB
 */
class JsonbResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => json_encode(fake()->words()),';
    }

    public function migration(): string
    {
        $migration = '$table->jsonb(\''.$this->column->field.'\')';

        return $this->last($migration);
    }

    public function nova(): ?string
    {
        return 'KeyValue::make(\''.Inflector::title($this->column->field).'\')->rules(\'json\'),';
    }
}
