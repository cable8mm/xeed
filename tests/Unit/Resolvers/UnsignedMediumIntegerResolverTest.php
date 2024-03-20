<?php

namespace Cable8mm\Xeed\Tests\Unit\Resolvers;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Resolvers\BigintResolver;
use Cable8mm\Xeed\Support\Picker;
use Cable8mm\Xeed\Xeed;
use PHPUnit\Framework\TestCase;

final class UnsignedMediumIntegerResolverTest extends TestCase
{
    public Column $column;

    public string $driver;

    protected function setUp(): void
    {
        $db = Xeed::getInstance();

        $this->column = Picker::of($db->attach()
            ->getTable('xeeds')
            ->getColumns()
        )->driver($db->driver)->field('unsigned_medium_integer')->type('int')->get();

        $this->driver = $db->driver;
    }

    public function test_column_can_not_null(): void
    {
        $this->assertNotNull($this->column);
    }

    public function test_resolver_can_be_created(): void
    {
        $resolver = new BigintResolver($this->column);

        $this->assertNotNull($resolver);
    }

    public function test_fake_method_can_working_well(): void
    {
        $resolver = new BigintResolver($this->column);

        $this->assertEquals('\''.$resolver->field.'\' => fake()->numerify(),', $resolver->fake());
    }

    public function test_migration_method_can_working_well(): void
    {
        $resolver = new BigintResolver($this->column);

        if ($this->driver == 'mysql') {
            $this->assertEquals('$table->bigInteger(\''.$resolver->field.'\');', $resolver->migration());
        }

        if ($this->driver == 'sqlite') {
            $this->assertEquals('$table->bigInteger(\''.$resolver->field.'\');', $resolver->migration());
        }
    }
}
