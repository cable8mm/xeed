<?php

namespace Cable8mm\Xeed;

/**
 * Database Column Object.
 */
final class Column
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
     * To get column information array.
     *
     * @return array Column information array
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
     * Column factory method.
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

    public function fake(): string
    {
        return ResolverSelector::of($this)->fake();
    }
}
