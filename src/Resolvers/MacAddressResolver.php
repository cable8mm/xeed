<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * MACADDRESS
 */
class MacaddressResolver extends Resolver
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
