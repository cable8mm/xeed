<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Support\Inflector;

/**
 * MULTIPOINT
 */
class MultipointResolver extends Resolver
{
    public function fake(): string
    {
        return '\''.$this->column->field.'\' => \'MULTIPOINT(0 0, 20 20, 60 60)\',';
    }

    public function migration(): string
    {
        $migration = '$table->multiPoint(\''.$this->column->field.'\')';

        return $this->last($migration);
    }

    public function nova(): ?string
    {
        return 'Textarea::make(\''.Inflector::title($this->column->field).'\'),';
    }
}
