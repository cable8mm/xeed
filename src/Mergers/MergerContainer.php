<?php

namespace Cable8mm\Xeed\Mergers;

use Cable8mm\Xeed\Generators\MigrationGenerator;
use Cable8mm\Xeed\Interfaces\MergerInterface;
use Cable8mm\Xeed\Support\File;
use InvalidArgumentException;
use LogicException;
use Stringable;

/**
 * Container for mergers.
 */
class MergerContainer implements Stringable
{
    /**
     * @var array<\Cable8mm\Xeed\Interfaces\MergerInterface>
     */
    private array $engines = [];

    /**
     * An array of migration files per lines.
     *
     * @var array<string>
     */
    private array $lines;

    private function __construct(
        private ?string $migration = null,
        private ?string $body = null
    ) {
        if (! is_null($migration)) {
            $this->body = File::system()->read($migration);
        }

        if (! is_null($this->body)) {
            $this->lines = explode(PHP_EOL, $this->body);
        }

        if (is_null($this->lines)) {
            throw new LogicException('$this->lines is never null.');
        }
    }

    /**
     * Add a engine.
     *
     * @param  Merger  $merger  An engine to be added.
     * @return static The method returns the current instance that enables method chaining.
     */
    public function engine(Merger $merger): static
    {
        $this->engines[] = $merger;

        return $this;
    }

    /**
     * Add engines.
     *
     * @param  array<MergerInstance>  $mergers  An array of engines to be added.
     * @return static The method returns the current instance that enables methods chaining.
     */
    public function engines(array $mergers): static
    {
        $this->engines += $mergers;

        return $this;
    }

    /**
     * Execute engines.
     *
     * @return static The method returns this instance that was execute all mergers.
     */
    public function operating(): static
    {
        $i = 0;
        $total = count($this->lines);

        foreach ($this->lines as $key => $line) {
            if ($i++ + 1 === $total) {
                break;
            }

            /* @var MergerInterface $engine */
            foreach ($this->engines as $engine) {
                $replace = $engine->start($this->lines[$key], $this->lines[$key + 1]);

                if ($replace !== null) {
                    $this->lines[$key + 1] = MigrationGenerator::INTENT.$replace;
                    $this->lines[$key] = null;

                    break;
                }
            }
        }

        $this->lines = array_values(array_filter($this->lines));

        return $this;
    }

    /**
     * Write a string to a file from the `$this->lines` array.
     */
    public function write(): void
    {
        File::system()->write(
            $this->migration,
            implode(PHP_EOL, $this->lines)
        );
    }

    /**
     * Print lines to string.
     *
     * @return string The method returns the string representation.
     */
    public function verbose(): string
    {
        return implode(PHP_EOL, $this->lines);
    }

    /**
     * Get an array representation of the array.
     *
     * @return array The method returns an array representation of the array.
     */
    public function toArray(): array
    {
        return $this->lines;
    }

    /**
     * Class magic method to get the real migration file path.
     *
     * @return string The method returns the real file path.
     */
    public function __toString(): string
    {
        return $this->migration ?? $this->body;
    }

    /**
     * Create a singleton instance.
     *
     * @param  string  $migration  Path to the migration file from root folder.
     * @param  string  $body  Migration string.
     * @return static The method return the instance that called the constructor.
     *
     * @throws InvalidArgumentException
     *
     * @example MergerContainer::from(migration: <migration_path>)->engines([...engines...])->operating()->write();
     * @example MergerContainer::from(body : <body>)->engines([...engines...])->operating()->verbose();
     */
    public static function from(?string $migration = null, ?string $body = null): static
    {
        if (! is_null($migration) !== ! is_null($body)) {
            return new static($migration, $body);
        }

        throw new InvalidArgumentException('One of the arguments must be null');
    }

    /**
     * Get all the engines.
     *
     * @return array The method returns an array of engines.
     */
    public static function getEngines(): array
    {
        return [
            new MorphsMerger(),
            new NullableMorphsMerger(),
            new NullableUlidMorphsMerger(),
            new NullableUuidMorphsMerger(),
            new TimestampsMerger(),
            new UlidMorphsMerger(),
            new UuidMorphsMerger(),
        ];
    }
}
