<?php

namespace Cable8mm\Xeed\Tests\Unit\Resolvers;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Resolvers\StringResolver;
use Cable8mm\Xeed\Support\Picker;
use Cable8mm\Xeed\Xeed;
use PHPUnit\Framework\TestCase;

final class StringResolverTest extends TestCase
{
    public Column $column;

    public string $driver;

    protected function setUp(): void
    {
        $xeed = Xeed::getInstance();

        $this->column = Picker::of($xeed->attach()
            ->getTable('xeeds')
            ->getColumns()
        )->driver($xeed->driver)->field('string')->get();

        $this->driver = $xeed->driver;
    }

    public function test_column_can_not_null(): void
    {
        $this->assertNotNull($this->column);
    }

    public function test_resolver_can_be_created(): void
    {
        $resolver = new StringResolver($this->column);

        $this->assertNotNull($resolver);
    }

    public function test_fake_method_can_working_well(): void
    {
        $resolver = new StringResolver($this->column);

        $this->assertEquals('\''.$resolver->field.'\' => fake()->text(),', $resolver->fake());
    }

    public function test_migration_method_can_working_well(): void
    {
        $resolver = new StringResolver($this->column);

        if ($this->driver == 'mysql') {
            $this->assertEquals('$table->string(\''.$resolver->field.'\', 100);', $resolver->migration());
        }

        if ($this->driver == 'sqlite') {
            $this->assertEquals('$table->string(\''.$resolver->field.'\');', $resolver->migration());
        }

        if ($this->driver == 'pgsql') {
            $this->assertEquals('$table->string(\''.$resolver->field.'\');', $resolver->migration());
        }
    }

    public function test_nova_method_can_working_well(): void
    {
        $this->column->field = 'string_field';

        $resolver = new StringResolver($this->column);

        $this->assertEquals('Text::make(\''.$this->column->title().'\')->maxlength(65535),', $resolver->nova());
    }
}
