<?php

namespace Cable8mm\Xeed\Tests\Unit\Resolvers;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Resolvers\UlidResolver;
use Cable8mm\Xeed\Support\Picker;
use Cable8mm\Xeed\Xeed;
use PHPUnit\Framework\TestCase;

final class UlidResolverTest extends TestCase
{
    public Column $column;

    protected function setUp(): void
    {
        $xeed = Xeed::getInstance();

        $this->column = Picker::of($xeed->attach()
            ->getTable('xeeds')
            ->getColumns()
        )->driver($xeed->driver)->field('ulid')->get();
    }

    public function test_column_can_not_null(): void
    {
        $this->assertNotNull($this->column);
    }

    public function test_resolver_can_be_created(): void
    {
        $resolver = new UlidResolver($this->column);

        $this->assertNotNull($resolver);
    }

    public function test_fake_method_can_working_well(): void
    {
        $resolver = new UlidResolver($this->column);

        $this->assertEquals('\''.$resolver->field.'\' => fake()->regexify(\'[a-zA-Z0-9]{26}\'),', $resolver->fake());
    }

    public function test_migration_method_can_working_well(): void
    {
        $resolver = new UlidResolver($this->column);

        $this->assertEquals('$table->ulid(\''.$resolver->field.'\');', $resolver->migration());
    }
}
