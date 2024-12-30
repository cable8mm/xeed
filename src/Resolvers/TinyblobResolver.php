<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * TINYBLOB
 *
 * For BLOBs (Binary Large OBjects).
 * Max length: 255 bytes
 */
final class TinyblobResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => fake()->randomLetter(),';
    }

    public function migration(): string
    {
        $migration = '$table->integer(\''.$this->column->field.'\')';

        return $this->last($migration);
    }

    public function nova(): ?string
    {
        return false;
    }
}
