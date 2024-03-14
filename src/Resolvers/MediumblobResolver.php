<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * MEDIUMBLOB
 *
 * For BLOBs (Binary Large OBjects).
 * Holds up to 16,777,215 bytes of data
 */
class MediumblobResolver extends Resolver
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
