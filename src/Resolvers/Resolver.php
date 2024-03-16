<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Column;

/**
 * Abstract resolver class.
 */
abstract class Resolver
{
    abstract protected function fake(): string;

    abstract protected function migration(): string;

    public function __construct(
        protected Column $column
    ) {

    }

    public function last($migration): string
    {
        if (! $this->column->notNull) {
            $migration .= '->nullable()';
        }

        if (! is_null($this->column->default)) {
            $migration .= '->default("'.$this->column->default.'")';
        }

        return $migration.';';
    }

    /**
     *  Reading data from inaccessible (protected or private) or non-existing properties.
     */
    public function __get(string $property): mixed
    {
        return $this->column->$property;
    }
}
