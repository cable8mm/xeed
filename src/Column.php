<?php

namespace Cable8mm\Xeed;

final class Column
{
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
