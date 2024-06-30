<?php

namespace Cable8mm\Xeed\Support;

use Cable8mm\Xeed\Column;
use InvalidArgumentException;

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
    ) {}

    /**
     * Set a field value.
     *
     * @param  string  $field  The field name.
     * @return static The method set `field` and it returns the current instance
     *
     * @example Picker::of(\Cable8mm\Xeed\Column[])->driver('mysql')->field('name')->get()
     */
    public function field(string $field): static
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Set a database driver.
     *
     * @param  string  $driver  The database driver name
     * @return static The method set `driver` and it returns the current instance
     *
     * @example Picker::of(\Cable8mm\Xeed\Column[])->driver($xeed->driver)->field('string')->get()
     */
    public function driver(string $driver): static
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get a driver value.
     *
     * @return string|null The driver value.
     *
     * @example Picker::of(\Cable8mm\Xeed\Column[])->driver($xeed->driver)->getDriver()
     */
    public function getDriver(): ?string
    {
        return $this->driver;
    }

    /**
     * Set a database field type.
     *
     * @param  string  $type  The column type
     *
     * @example Picker::of(\Cable8mm\Xeed\Column[])->type('varchar')
     */
    public function type(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get a specific column
     *
     * @param  string  $driver  The driver.
     * @param  string  $field  The field.
     * @param  string  $type  The type.
     * @return \Cable8mm\Xeed\Column|null The Column instance
     *
     * @throws InvalidArgumentException When the driver is invalid or the field type is not supported
     *
     * @example Picker::of(\Cable8mm\Xeed\Column[])->driver($xeed->driver)->field('string')->get()
     * @example Picker::of(\Cable8mm\Xeed\Column[])->get(driver: 'mysql', field: 'name', type: 'varchar')->get()
     * @example Picker::of(\Cable8mm\Xeed\Column[])->get(driver: 'mysql', field: 'name')->get()
     * @example Picker::of(\Cable8mm\Xeed\Column[])->get(driver: 'mysql', type: 'varchar')->get()
     */
    public function get(
        ?string $driver = null,
        ?string $field = null,
        ?string $type = null,
    ): ?Column {
        $driver = $driver ?? $this->driver;
        $field = $field ?? $this->field;
        $type = $type ?? $this->type;

        if ($driver === null) {
            throw new InvalidArgumentException('You must provide a driver');
        }

        if ($field === null && $type === null) {
            throw new InvalidArgumentException('You must provide a field or a type or both');
        }

        /* @var Column $value */
        foreach ($this->values as $value) {
            if (
                (! is_null($field) && is_null($type) && $value->field == $field && $value->type == $type) ||
                (! is_null($field) && $value->field == $field) ||
                (! is_null($type) && $value->type == $type)
            ) {
                return $value;
            }
        }

        return null;
    }

    /**
     * Get an array of An array of `Table` instances.
     *
     * @return array<\Cable8mm\Xeed\Column> An array of An array of `\Cable8mm\Xeed\Table` instances.
     */
    public function toArray(): array
    {
        return $this->values;
    }

    /**
     * Create a instance.
     *
     * @param  array<\Cable8mm\Xeed\Table>  $values  An array of `\Cable8mm\Xeed\Table` instances.
     * @return static The Picker instance.
     *
     * @example Picker::of($xeed->attach()->getTable('xeeds')->getColumns())->driver($xeed->driver)->field('string')->get()
     */
    public static function of(array $values): static
    {
        return new self($values);
    }
}
