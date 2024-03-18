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

    public function left(): string|int
    {
        if (! is_array($this->parsed) || ! isset($this->parsed[0])) {
            throw new InvalidArgumentException('Left value is not set');
        }

        return $this->parsed[0];
    }

    public function right(): string|int
    {
        if (! is_array($this->parsed) || ! isset($this->parsed[1])) {
            throw new InvalidArgumentException('Right value is not set');
        }

        return $this->parsed[1];
    }

    public function to(): string|int
    {
        if (! is_string($this->parsed) || (bool) is_int($this->parsed)) {
            throw new InvalidArgumentException('Right value is not set');
        }

        return $this->parsed;
    }

    public function escape(): string
    {
        $value = preg_replace('/[()]/', '', $this->value);

        return preg_replace('/,/', ' ,', $value);
    }

    /**
     * Class magic method to get the instance information for a Exception
     *
     * @return string The instance information for a Exception
     */
    public function __toString()
    {
        return (string) $this->to();
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
