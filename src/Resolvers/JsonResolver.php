<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * JSON
 */
class JsonResolver extends Resolver implements ResolverInterface
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
