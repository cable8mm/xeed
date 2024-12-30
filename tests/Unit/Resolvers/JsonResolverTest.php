<?php

namespace Cable8mm\Xeed\Tests\Unit\Resolvers;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Resolvers\JsonResolver;
use Cable8mm\Xeed\Support\Picker;
use Cable8mm\Xeed\Xeed;
use PHPUnit\Framework\TestCase;

final class JsonResolverTest extends TestCase
{
    public Column $column;

    protected function setUp(): void
    {
        $xeed = Xeed::getInstance();

        $this->column = Picker::of($xeed->attach()
            ->getTable('xeeds')
            ->getColumns()
        )->driver($xeed->driver)->field('json')->get();
    }

    public function test_column_can_not_null(): void
    {
        $this->assertNotNull($this->column);
    }

    public function test_resolver_can_be_created(): void
    {
        $resolver = new JsonResolver($this->column);

        $this->assertNotNull($resolver);
    }

    public function test_fake_method_can_working_well(): void
    {
        $resolver = new JsonResolver($this->column);

        $this->assertEquals('\''.$resolver->field.'\' => json_encode(fake()->words()),', $resolver->fake());
    }

    public function test_migration_method_can_working_well(): void
    {
        $resolver = new JsonResolver($this->column);

        $this->assertEquals('$table->json(\''.$resolver->field.'\');', $resolver->migration());
    }

    public function test_nova_method_can_working_well(): void
    {
        $this->column->field = 'json_field';

        $resolver = new JsonResolver($this->column);

        $this->assertEquals('KeyValue::make(\''.$this->column->title().'\')->rules(\'json\'),', $resolver->nova());
    }
}
