<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Interfaces\ResolverInterface;
use LogicException;

/**
 * It is used by parent class of various resolver classes.
 */
class Resolver implements ResolverInterface
{
    /**
     * Constructor.
     *
     * @param  \Cable8mm\Xeed\Column  $column  The column.
     */
    public function __construct(
        protected Column $column
    ) {

    }

    /**
     * {@inheritDoc}
     *
     * @internal This method should be implemented by child classes.
     *
     * @throw LogicException
     */
    public function fake(): string
    {
        throw new LogicException(__METHOD__.' Method not implemented.');
    }

    /**
     * {@inheritDoc}
     *
     * @internal This method should be implemented by child classes.
     *
     * @throw LogicException
     */
    public function migration(): string
    {
        throw new LogicException(__METHOD__.' Method not implemented.');
    }

    /**
     * Post processing method for resolvers
     *
     * @param  string  $migration  The migration payload before post processing
     * @return string The migration payload after post processing
     */
    public function last(string $migration): string
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
