<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Interfaces\ResolverInterface;
use LogicException;

/**
 * It is used by parent class of various resolver classes.
 */
abstract class Resolver implements ResolverInterface
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
    abstract public function fake(): string;

    /**
     * {@inheritDoc}
     *
     * @internal This method should be implemented by child classes.
     *
     * @throw LogicException
     */
    abstract public function migration(): string;

    /**
     * Finally process for resolvers
     *
     * @param  string  $migration  The migration payload before post processing
     * @return string The method returns the migration payload after post processing
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
     * Reading data from inaccessible (protected or private) or non-existing properties.
     *
     * @param  string  $property  The property name.
     * @return mixed The value of the `column` property.
     */
    public function __get(string $property): mixed
    {
        return $this->column->$property;
    }
}
