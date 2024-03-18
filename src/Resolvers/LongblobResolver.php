<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * LONGBLOB
 *
 * For BLOBs (Binary Large OBjects).
 * Holds up to 4,294,967,295 bytes of data
 */
class LongblobResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->sentence(),';
    }

    public function migration(): string
    {
        $migration = '$table->text(\''.$this->column->field.'\')';

        return $this->last($migration);
    }
}
