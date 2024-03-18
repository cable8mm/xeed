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
     * @example echo (new Table('users'))->model();
     * //=> User
     */
    public function model(?string $postfix = null): string
    {
        return Inflector::classify($this->name).$postfix;
    }

    /**
     * To get the migration file name from table name.
     *
     * @return string The migration file name.
     *
     * @example echo (new Table('users'))->migration();
     * //=> 2024_03_18_135821_create_users_table.php
     */
    public function migration(): string
    {
        return date('Y_m_d_His').'_create_'.$this->name.'_table.php';
    }

    /**
     * Class magic method to get the real table name.
     *
     * @return string The real table name.
     *
     * @example echo new Table('users');
     * //=> users
     */
    public function __toString(): string
    {
        return $this->name;
    }
}
