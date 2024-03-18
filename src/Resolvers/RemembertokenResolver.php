<?php

namespace Cable8mm\Xeed\Resolvers;

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
        $migration = '$table->rememberToken()';

        return $this->last($migration);
    }
}
