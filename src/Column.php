<?php

namespace Cable8mm\Xeed;

final class Column
{
    public string $field;

    public string $type;

    public ?string $bracket;

    public string $null;

    public string $key;

    public string $default;

    public string $extra;

    public function __construct(array $column)
    {
        $this->field = $column['Field'];
        $this->null = $column['Type'];
        $this->key = $column['Key'];
        $this->default = $column['Default'];
        $this->extra = $column['Extra'];

        $this->type = preg_match('/(/', $column['Type']) ? preg_replace('/\(.+?/', '', $column['Type']) : $column['Type'];
        $this->bracket = preg_match('/(/', $column['Type']) ? (int) preg_replace('/.+\((.+)\).+?/', '\\1', $column['Type']) : null;
    }

    public function toArray(): array
    {
        return [
            'Field' => $this->field,
            'Type' => is_null($this->bracket) ? $this->type : $this->type.'('.$this->bracket.')',
            'Null' => $this->null,
            'Key' => $this->key,
            'Default' => $this->default,
            'Extra' => $this->extra,
        ];
    }
}
