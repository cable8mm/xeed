<?php

namespace Cable8mm\Xeed\Tests\Unit\Resolvers;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Resolvers\FloatResolver;
use Cable8mm\Xeed\Support\Picker;
use Cable8mm\Xeed\Xeed;
use PHPUnit\Framework\TestCase;

final class FloatResolverTest extends TestCase
{
    public Column $column;

    public string $driver;

    protected function setUp(): void
    {
        $xeed = Xeed::getInstance();

        $this->column = Picker::of($xeed->attach()
            ->getTable('xeeds')
            ->getColumns()
        )->driver($xeed->driver)->field('float')->get();

        $this->driver = $xeed->driver;
    }

    public function test_column_can_not_null(): void
    {
        $this->assertNotNull($this->column);
    }

    public function test_resolver_can_be_created(): void
    {
        $resolver = new FloatResolver($this->column);

        $this->assertNotNull($resolver);
    }

    public function test_fake_method_can_working_well(): void
    {
        $resolver = new FloatResolver($this->column);

        $this->assertEquals('\'float\' => fake()->randomFloat(),', $resolver->fake());
    }

    public function test_migration_method_can_working_well(): void
    {
        $resolver = new FloatResolver($this->column);

        if ($this->driver === 'mysql') {
            $this->assertEquals('$table->float(\'float\', 8, 2);', $resolver->migration());
        }

        if ($this->driver === 'sqlite') {
            $this->assertEquals('$table->float(\'float\');', $resolver->migration());
        }

        if ($this->driver == 'pgsql') {
            $this->assertEquals('$table->float(\'float\', 24, 2);', $resolver->migration());
        }
    }
}
