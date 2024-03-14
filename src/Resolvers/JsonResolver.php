<?php

namespace Cable8mm\Xeed\Resolvers;

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
}
