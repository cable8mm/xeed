<?php

namespace Cable8mm\Xeed\Resolvers;

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
}
