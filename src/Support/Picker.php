<?php

namespace Cable8mm\Xeed\Support;

use Cable8mm\Xeed\Column;
use UnexpectedValueException;

/**
 * Various methods for selecting what you want.
 */
final class Picker
{
    private function __construct(
        private array $values,
        private ?string $driver = null,
        private ?string $field = null,
        private ?string $type = null,
    ) {

    }

    public function field(string $field): static
    {
        $this->field = $field;

        return $this;
    }

    public function driver(string $driver): static
    {
        $this->driver = $driver;

        return $this;
    }

    public function type(string $type): ?Column
    {
        $this->type = $type;

        return $this->get();
    }

    public function get(): ?Column
    {
        if ($this->driver === null) {
            throw new UnexpectedValueException('You must provide a driver');
        }

        // if ($this->field === null) {
        //     throw new UnexpectedValueException('You must provide a field');
        // }

        $mapper = require Path::mapper().$this->driver.'.php';

        /* @var Column $value */
        foreach ($this->values as $value) {
            if ($value->type == $this->type) {
                return $value;
            }
        }

        return null;
    }

    public static function of(array $values): static
    {
        return new self($values);
    }
}
