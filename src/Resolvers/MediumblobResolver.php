<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * MEDIUMBLOB
 *
 * For BLOBs (Binary Large OBjects).
 * Holds up to 16,777,215 bytes of data
 */
class MediumblobResolver extends Resolver implements ResolverInterface
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->paragraph(),';
    }

    public function migration(): string
    {
        $migration = '$table->text(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
