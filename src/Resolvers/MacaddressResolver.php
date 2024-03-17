<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * MACADDRESS
 */
class MacaddressResolver extends Resolver implements ResolverInterface
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->macAddress(),';
    }

    public function migration(): string
    {
        $migration = '$table->macAddress(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
