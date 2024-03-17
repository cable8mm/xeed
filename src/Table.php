<?php

namespace Cable8mm\Xeed;

use Cable8mm\Xeed\Support\Inflector;
use Stringable;

/**
 * Database Table Object.
 */
final class Table implements Stringable
{
    /**
     * Table name.
     */
    private string $name;

    /**
     * Column array.
     *
     * @var array<Column>
     */
    private array $columns = [];

    /**
     * Table constructor.
     *
     * @param  string  $name  Table name
     * @param  array<Table>  $columns  Column array[Table]
     */
    public function __construct(string $name, array $columns = [])
    {
        $this->name = $name;

        $this->columns = $columns;
    }

    /**
     * To get column array.
     *
     * @return array<Column> Column array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * To get the model name from table name.
     *
     * @return string The ModelName
     *
     * @example `User` `Admin`
     */
    public function model(): string
    {
        return Inflector::classify($this->name);
    }

    public function __toString()
    {
        return $this->name;
    }
}
