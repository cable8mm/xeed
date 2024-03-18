<?php

namespace Cable8mm\Xeed\Types;

use InvalidArgumentException;
use Stringable;

class Bracket implements Stringable
{
    private array|string $parsed;

    private function __construct(
        private string $value,
    ) {
        // pattern : (8, 2)
        if (preg_match('/\(([0-9 ]+),([0-9 ]+)\)/', $value, $parsed)) {
            $this->parsed = [0 => $parsed[1], trim($parsed[2])];
        }
        // pattern : int unsigned
        elseif (preg_match('/([a-zA-Z0-9]+) ([a-zA-Z0-9]+)/', $value, $parsed)) {
            $this->parsed = [0 => $parsed[1], trim($parsed[2])];
        }
        // not matched any pattern
        else {
            $this->parsed = $value;
        }
    }

    /**
     * Reading data from inaccessible (protected or private) or non-existing properties.
     *
     * @throws InvalidArgumentException
     */
    public function __get(string $property): mixed
    {
        switch ($property) {
            case 'left':
                if (! is_array($this->parsed) || ! isset($this->parsed[0])) {
                    throw new InvalidArgumentException('Left value is not set');
                }

                return $this->parsed[0];
            case 'right':
                if (! is_array($this->parsed) || ! isset($this->parsed[1])) {
                    throw new InvalidArgumentException('Left value is not set');
                }

                return $this->parsed[1];
            case 'value':
                if (! is_string($this->parsed)) {
                    throw new InvalidArgumentException('Value is not string');
                }

                return $this->parsed;
        }

        throw new InvalidArgumentException('Invalid property: '.$property);
    }

    /**
     * Class magic method to get the instance information for a Exception
     *
     * @return string The instance information for a Exception
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * Factory method to get a Bracket instance.
     *
     * @param  string  $values  The value of database bracket.
     * @return static The Bracket instance.
     *
     * @example echo Bracket::of('int unsigned')
     * @example echo Bracket::of('int unsigned')->left
     * @example echo Bracket::of('int unsigned')->right
     */
    public static function of(string $value): static
    {
        return new self(
            $value
        );
    }
}
