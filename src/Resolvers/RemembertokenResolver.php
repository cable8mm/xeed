<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * REMEMBERTOKEN
 */
class RemembertokenResolver extends Resolver implements ResolverInterface
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
