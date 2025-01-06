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
     * Foreign key array.
     *
     * @var array<\Cable8mm\Xeed\ForeignKey>
     */
    private array $foreignKeys = [];

    /**
     * Constructor.
     *
     * @param  string  $name  Table name
     * @param  array<\Cable8mm\Xeed\Table>|null  $columns  Column array[Table]
     * @param  array<\Cable8mm\Xeed\ForeignKey>|null  $foreignKeys  Foreign key array
     */
    public function __construct(string $name, ?array $columns = [], ?array $foreignKeys = [])
    {
        assert(! empty($columns), new LogicException('Columns must not be empty'));

        $this->name = $name;

        $this->columns = $columns;

        $this->foreignKeys = $foreignKeys;
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
     * Get key array.
     *
     * @return array<\Cable8mm\Xeed\ForeignKey> The method returns `\Cable8mm\Xeed\Key` array
     */
    public function getForeignKeys(): array
    {
        return $this->foreignKeys;
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
     * Get the Nova resource name from table name.
     *
     * @return string The method returns the NovaResourceName
     *
     * @example echo (new Table('users'))->nova();
     * //=> User
     */
    public function nova(?string $suffix = null): string
    {
        return $this->model($suffix);
    }

    /**
     * Get the title for Nova resource name from table name.
     *
     * @return string The method returns the title for NovaResource name
     *
     * @example echo (new Table('users'))->title();
     * //=> User
     */
    public function title(?string $suffix = null): string
    {
        return Inflector::title($this->name).$suffix;
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
     * Let it know if the table has timestamps.
     */
    public function hasTimestamps(): bool
    {
        return ! (
            in_array('created_at', array_column($this->columns, 'field')) &&
            in_array('updated_at', array_column($this->columns, 'field'))
        );
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
