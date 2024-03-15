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
    ) {

    }

    public function field(string $field): ?Column
    {
        /* @var Column $value */
        foreach ($this->values as $value) {
            if ($value->field == $field) {
                return $value;
            }
        }

        return null;
    }

    public function type(string $type): ?Column
    {
        if ($this->driver === null) {
            throw new UnexpectedValueException('You must provide a driver');
        }

        $mapper = require Path::mapper().$this->driver.'.php';

        /* @var Column $value */
        foreach ($this->values as $value) {
            if ($value->type == $mapper[$type]) {
                return $value;
            }
        }

        return null;
    }

    public function driver(string $driver): static
    {
        $this->driver = $driver;

        return $this;
    }

    public static function of(array $values): static
    {
        return new self($values);
    }
}
