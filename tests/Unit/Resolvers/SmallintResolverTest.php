<?php

namespace Cable8mm\Xeed\Tests\Unit\Resolvers;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\DB;
use Cable8mm\Xeed\Resolvers\SmallintResolver;
use Cable8mm\Xeed\Support\Picker;
use PHPUnit\Framework\TestCase;

final class SmallintResolverTest extends TestCase
{
    public Column $column;

    public string $driver;

    protected function setUp(): void
    {
        $db = DB::getInstance();

        $this->column = Picker::of($db->attach()
            ->getTable('xeeds')
            ->getColumns()
        )->driver($db->driver)->field('small_integer')->get();

        $this->driver = $db->driver;
    }

    public function test_column_can_not_null(): void
    {
        $this->assertNotNull($this->column);
    }

    public function test_resolver_can_be_created(): void
    {
        $resolver = new SmallintResolver($this->column);

        $this->assertNotNull($resolver);
    }

    public function test_fake_method_can_working_well(): void
    {
        $resolver = new SmallintResolver($this->column);

        $this->assertEquals('\''.$resolver->field.'\' => fake()->numberBetween(0, 32767),', $resolver->fake());
    }

    public function test_migration_method_can_working_well(): void
    {
        $resolver = new SmallintResolver($this->column);

        if ($this->driver == 'mysql') {
            $this->assertEquals('$table->unsignedSmallInteger(\''.$resolver->field.'\');', $resolver->migration());
        }

        if ($this->driver == 'sqlite') {
            $this->assertEquals('$table->smallInteger(\''.$resolver->field.'\');', $resolver->migration());
        }
    }
}
