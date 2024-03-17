<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * JSONB
 */
class JsonbResolver extends Resolver implements ResolverInterface
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
