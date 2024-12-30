<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Support\Inflector;

/**
 * ULIDMORPHS
 */
class UlidmorphsResolver extends Resolver
{
    public function fake(): string
    {
        // TODO: implement this method for ulid morphs
        return '';
    }

    public function migration(): string
    {
        $migration = '$table->ulidMorphs(\''.$this->column->field.'\')';

        return $this->last($migration);
    }

    public function nova(): ?string
    {
        $columnId = Inflector::title($this->column->field).' Id';
        $type = Inflector::title($this->column->field).' Type';

        return 'Text::make(\''.$columnId.'\'),'.PHP_EOL.'Text::make(\''.$type.'\'),';
    }
}
