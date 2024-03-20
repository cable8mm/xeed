<?php

namespace Cable8mm\Xeed;

use Stringable;

/**
 * Database Column Object.
 */
final class Column implements Stringable
{
    /**
     * Column constructor.
     *
     * @param  string  $field  Name of the column
     * @param  string  $type  Type of the column
     * @param  bool  $unsigned  Nullable flag
     * @param  bool  $autoIncrement  Nullable flag
     * @param  bool  $notNull  Nullable flag
     * @param  bool  $primaryKey  Key of the column
     * @param  string|null  $bracket  Length or something of the column
     * @param  string|null  $default  Default value
     * @param  string|null  $extra  Extra information of the column
     */
    public function __construct(
        public string $field,
        public string $type,
        public bool $unsigned = false,
        public bool $autoIncrement = false,
        public bool $notNull = false,
        public bool $primaryKey = false,
        public ?string $bracket = null,
        public ?string $default = null,
        public ?string $extra = null
    ) {
        $this->type = strtolower($type);
    }

    /**
     * Get column information array.
     *
     * @return array The method returns column information array
     */
    public function toArray(): array
    {
        return [
            'field' => $this->field,
            'type' => $this->type,
            'unsigned' => $this->unsigned,
            'notNull' => $this->notNull,
            'autoIncrement' => $this->autoIncrement,
            'bracket' => $this->bracket,
            'primaryKey' => $this->primaryKey,
            'default' => $this->default,
            'extra' => $this->extra,
        ];
    }

    /**
     * Create a instance.
     *
     * @param  string  $field  Name of the column
     * @param  string  $type  Type of the column
     * @param  bool  $unsigned  Nullable flag
     * @param  bool  $autoIncrement  Nullable flag
     * @param  bool  $notNull  Nullable flag
     * @param  bool  $primaryKey  Key of the column
     * @param  string|null  $bracket  Length or something of the column
     * @param  string|null  $default  Default value
     * @param  string|null  $extra  Extra information of the column
     */
    public static function make(
        string $field,
        string $type,
        bool $unsigned = false,
        bool $autoIncrement = false,
        bool $notNull = false,
        bool $primaryKey = false,
        ?string $bracket = null,
        ?string $default = null,
        ?string $extra = null
    ): static {
        return new self(
            $field,
            $type,
            $unsigned,
            $autoIncrement,
            $notNull,
            $primaryKey,
            $bracket,
            $default,
            $extra
        );
    }

    /**
     * Get the row string form database factory, then return the string for Seeder class.
     *
     * @return string The method returns a Seeder class row string
     */
    public function fake(): string
    {
        return ResolverSelector::of($this)->fake();
    }

    /**
     * Get the row string for migration file, then return the string for migration class.
     *
     * @return string The method returns a Migration class row string
     */
    public function migration(): string
    {
        return ResolverSelector::of($this)->migration();
    }

    /**
     * Class magic method to get the instance information for a Exception
     *
     * @return string The method returns the instance information for a Exception
     */
    public function __toString(): string
    {
        return 'Field is '.$this->field.' and type is '.$this->type.'.';
    }
}
