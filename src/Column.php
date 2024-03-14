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
     * @param  bool  $nullable  Nullable flag
     * @param  bool  $key  Key of the column
     * @param  string|null  $bracket  Length or something of the column
     * @param  string|null  $default  Default value
     * @param  string|null  $extra  Extra information of the column
     */
    public function __construct(
        public string $field,
        public string $type,
        public bool $nullable,
        public bool $key,
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
            'nullable' => $this->nullable,
            'bracket' => $this->bracket,
            'key' => $this->key,
            'default' => $this->default,
            'extra' => $this->extra,
        ];
    }
}
