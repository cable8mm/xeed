<?php

namespace Cable8mm\Xeed;

final class Table
{
    /**
     * @var string Table name.
     */
    public string $name;

    /**
     * @var array<Column> Column array.
     */
    public array $columns = [];

    public function __construct(string $name, array $columns)
    {
        $this->name = $name;

        $this->columns = $columns;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }
}
