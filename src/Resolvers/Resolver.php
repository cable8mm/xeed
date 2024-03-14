<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Column;

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
        if ($this->column->nullable) {
            $migration .= '->nullable()';
        }

        if (! is_null($this->column->default)) {
            $migration .= '->default("'.$this->column->default.'")';
        }

        return $migration.';';
    }
}
