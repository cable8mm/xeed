<?php

namespace Cable8mm\Xeed\Tests\Unit\Resolvers;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Resolvers\DecimalResolver;
use Cable8mm\Xeed\Support\Picker;
use Cable8mm\Xeed\Xeed;
use PHPUnit\Framework\TestCase;

final class DecimalResolverTest extends TestCase
{
    public Column $column;

    public string $driver;

    protected function setUp(): void
    {
        $db = Xeed::getInstance();

        $this->column = Picker::of($db->attach()
            ->getTable('xeeds')
            ->getColumns()
        )->driver($db->driver)->field('decimal')->get();

        $this->driver = $db->driver;
    }

    public function test_column_can_not_null(): void
    {
        $this->assertNotNull($this->column);
    }

    public function test_resolver_can_be_created(): void
    {
        $resolver = new DecimalResolver($this->column);

        $this->assertNotNull($resolver);
    }

    public function test_fake_method_can_working_well(): void
    {
        $resolver = new DecimalResolver($this->column);

        $this->assertEquals('\''.$resolver->field.'\' => fake()->randomFloat(2, 0, 10000),', $resolver->fake());
    }

    public function test_migration_method_can_working_well(): void
    {
        $resolver = new DecimalResolver($this->column);

        if ($this->driver == 'mysql') {
            $this->assertEquals('$table->decimal(\''.$resolver->field.'\', 8, 2);', $resolver->migration());
        }

        if ($this->driver == 'sqlite') {
            $this->assertEquals('$table->decimal(\''.$resolver->field.'\');', $resolver->migration());
        }
    }
}
