<?php

namespace Cable8mm\Xeed\Tests\Unit\Resolvers;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Resolvers\DoubleResolver;
use Cable8mm\Xeed\Resolvers\FloatResolver;
use Cable8mm\Xeed\Support\Picker;
use Cable8mm\Xeed\Xeed;
use PHPUnit\Framework\TestCase;

final class DoubleResolverTest extends TestCase
{
    public Column $column;

    public string $driver;

    protected function setUp(): void
    {
        $xeed = Xeed::getInstance();

        $this->column = Picker::of($xeed->attach()
            ->getTable('xeeds')
            ->getColumns()
        )->driver($xeed->driver)->field('double')->get();

        $this->driver = $xeed->driver;
    }

    public function test_column_can_not_null(): void
    {
        $this->assertNotNull($this->column);
    }

    public function test_resolver_can_be_created(): void
    {
        $resolver = new DoubleResolver($this->column);

        $this->assertNotNull($resolver);
    }

    public function test_fake_method_can_working_well(): void
    {
        $resolver = new FloatResolver($this->column);

        $this->assertEquals('\'double\' => fake()->randomFloat(),', $resolver->fake());
    }

    public function test_migration_method_can_working_well(): void
    {
        $resolver = new DoubleResolver($this->column);

        if ($this->driver === 'mysql') {
            $this->assertEquals('$table->double(\'double\', 8, 2);', $resolver->migration());
        }

        if ($this->driver === 'pgsql') {
            $this->assertEquals('$table->double(\'double\', 53, 2);', $resolver->migration());
        }

        if ($this->driver === 'sqlite') {
            $this->assertEquals('$table->double(\'double\');', $resolver->migration());
        }
    }

    public function test_nova_method_can_working_well(): void
    {
        $this->column->field = 'double_field';

        $resolver = new DoubleResolver($this->column);

        $this->assertEquals('Number::make(\''.$this->column->title().'\')->step(\'any\'),', $resolver->nova());
    }
}
