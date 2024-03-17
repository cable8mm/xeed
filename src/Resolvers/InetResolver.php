<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * INET
 *
 * When using Postgres, an INET column will be created.
 */
class InetResolver extends Resolver implements ResolverInterface
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->localIpv4(),';
    }

    public function migration(): string
    {
        $migration = '$table->ipAddress(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
