<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * BLOB(size)
 *
 * For BLOBs (Binary Large OBjects).
 * Holds up to 65,535 bytes of data
 */
final class BlobResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->sha1(),';
    }

    public function migration(): string
    {
        $migration = '$table->binary(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
