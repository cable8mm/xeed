<?php

namespace Cable8mm\Xeed\Resolvers;

/**
 * ENUM(val1, val2, val3, ...)
 *
 * A string object that can have only one value, chosen from a list of possible values.
 * You can list up to 65535 values in an ENUM list.
 * If a value is inserted that is not in the list, a blank value will be inserted.
 * The values are sorted in the order you enter them
 */
class EnumResolver extends Resolver
{
    public function fake(): string
    {
        // TODO: Replace 1,2,3 with real values
        return '\''.$this->column->field.'\' => fake()->randomElements(1,2,3),';
    }

    public function migration(): string
    {
        // TODO: $table->enum('difficulty', ['easy', 'hard']);
        $migration = '$table->enum(\''.$this->column->field.'\', '.$this->column->bracket.')';

        return $this->last($migration);
    }
}
