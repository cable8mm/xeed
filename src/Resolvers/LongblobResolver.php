<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Interfaces\ResolverInterface;

/**
 * LONGBLOB
 *
 * For BLOBs (Binary Large OBjects).
 * Holds up to 4,294,967,295 bytes of data
 */
class LongblobResolver extends Resolver implements ResolverInterface
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
