<?php

namespace Cable8mm\Xeed;

use Cable8mm\Xeed\Support\Inflector;
use Stringable;

/**
 * Database ForeignKey Object.
 */
final class ForeignKey implements Stringable
{
    /**
     * ForeignKey constructor.
     *
     * @param  string  $name  Name of the key
     * @param  string  $table  Table name
     * @param  string  $column  Column name
     * @param  string  $referenced_table  Referenced table name
     * @param  string  $referenced_column  Referenced column name
     */
    public function __construct(
        public string $name,
        public string $table,
        public string $column,
        public string $referenced_table,
        public string $referenced_column,
    ) {}

    /**
     * Get column information array.
     *
     * @return array The method returns column information array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'table' => $this->table,
            'column' => $this->column,
            'referenced_table' => $this->referenced_table,
            'referenced_column' => $this->referenced_column,
        ];
    }

    /**
     * Create a instance.
     *
     * @param  string  $name  Name of the key
     * @param  string  $table  Table name
     * @param  string  $column  Column name
     * @param  string  $referenced_table  Referenced table name
     * @param  string  $referenced_column  Referenced column name
     */
    public static function make(
        string $name,
        string $table,
        string $column,
        string $referenced_table,
        string $referenced_column,
    ): static {
        return new self(
            $name,
            $table,
            $column,
            $referenced_table,
            $referenced_column
        );
    }

    /**
     * Get the belongsTo relation from this model to another.
     *
     * @return string The method returns a relation function string
     */
    public function belongsTo(): string
    {
        $secondParam = '';
        if ($this->referenced_column !== 'id') {
            $secondParam = ', \''.$this->referenced_column.'\'';
        }

        return '    public function '.Inflector::tableize($this->referenced_table).'()'.PHP_EOL.
            '    {'.PHP_EOL.
            '        return $this->belongsTo('.$this->referenced_table.'::class, \''.$this->column.'\''.$secondParam.');'.PHP_EOL.
            '    }';
    }

    /**
     * Get the hasMany relation from another model to this.
     *
     * @return string The method returns a relation function string
     */
    public function hasMany(): string
    {
        $secondParam = '';
        if ($this->referenced_column !== 'id') {
            $secondParam = ', \''.$this->referenced_column.'\'';
        }

        return '    public function '.Inflector::pluralize($this->table).'()'.PHP_EOL.
            '    {'.PHP_EOL.
            '        return $this->hasMany('.$this->table.'::class, \''.$this->column.'\''.$secondParam.');'.PHP_EOL.
            '    }';
    }

    /**
     * Class magic method to get the instance information for a Exception
     *
     * @return string The method returns the instance information for a Exception
     */
    public function __toString(): string
    {
        return 'Foreign Key is '.$this->name.' and table is '.$this->table.'.';
    }
}
