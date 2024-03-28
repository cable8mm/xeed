<?php

namespace Cable8mm\Xeed;

use Cable8mm\Xeed\Support\Inflector;
use LogicException;
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
     * @var array<\Cable8mm\Xeed\Column>
     */
    private array $columns = [];

    /**
     * Constructor.
     *
     * @param  string  $name  Table name
     * @param  array<\Cable8mm\Xeed\Table>  $columns  Column array[Table]
     */
    public function __construct(string $name, ?array $columns = [])
    {
        assert(! empty($columns), new LogicException('Columns must not be empty'));

        $this->name = $name;

        $this->columns = $columns;
    }

    /**
     * Get column array.
     *
     * @return array<\Cable8mm\Xeed\Column> The method returns `\Cable8mm\Xeed\Column` array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * Get the model name from table name.
     *
     * @return string The method returns the ModelName
     *
     * @example echo (new Table('users'))->model();
     * //=> User
     */
    public function model(?string $suffix = null): string
    {
        return Inflector::classify($this->name).$suffix;
    }

    /**
     * Get the factory name from table name.
     *
     * @return string The method returns the FactoryName
     *
     * @example echo (new Table('users'))->factory();
     * //=> User
     */
    public function factory(?string $suffix = null): string
    {
        return Inflector::classify($this->name).'Factory'.$suffix;
    }

    /**
     * Get the seeder name from table name.
     *
     * @return string The method returns the SeederName
     *
     * @example echo (new Table('users'))->seeder();
     * //=> User
     */
    public function seeder(?string $suffix = null): string
    {
        return Inflector::classify($this->name).'Seeder'.$suffix;
    }

    /**
     * Get the migration file name from table name.
     *
     * @return string The method returns the migration file name.
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
     * @return string The method returns the real table name.
     *
     * @example echo new Table('users');
     * //=> users
     */
    public function __toString(): string
    {
        return $this->name;
    }
}
