<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * INET
 *
 * When using Postgres, an INET column will be created.
 */
class InetResolver extends Resolver
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
