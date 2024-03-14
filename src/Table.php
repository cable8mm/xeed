<?php

namespace Cable8mm\Xeed;

/**
 * Database Table Object.
 */
final class Table
{
    /**
     * Table name.
     */
    public string $name;

    /**
     * Column array.
     *
     * @var array<Column>
     */
    public array $columns = [];

    /**
     * Table constructor.
     *
     * @param  string  $name  Table name
     * @param  array<Table>  $columns  Column array[Table]
     */
    public function __construct(string $name, array $columns)
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
}
