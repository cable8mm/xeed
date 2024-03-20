<?php

namespace Cable8mm\Xeed\Tests\Unit\Resolvers;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Resolvers\RemembertokenResolver;
use Cable8mm\Xeed\Support\Picker;
use Cable8mm\Xeed\Xeed;
use PHPUnit\Framework\TestCase;

final class RemembertokenResolverTest extends TestCase
{
    public Column $column;

    protected function setUp(): void
    {
        $db = Xeed::getInstance();

        $this->column = Picker::of($db->attach()
            ->getTable('xeeds')
            ->getColumns()
        )->driver($db->driver)->field('remember_token')->get();
    }

    public function test_column_can_not_null(): void
    {
        $this->assertNotNull($this->column);
    }

    public function test_resolver_can_be_created(): void
    {
        $resolver = new RemembertokenResolver($this->column);

        $this->assertNotNull($resolver);
    }

    public function test_fake_method_can_working_well(): void
    {
        $resolver = new RemembertokenResolver($this->column);

        $this->assertEquals('\''.$resolver->field.'\' => fake()->sha256(),', $resolver->fake());
    }

    public function test_migration_method_can_working_well(): void
    {
        $resolver = new RemembertokenResolver($this->column);

        $this->assertEquals('$table->rememberToken();', $resolver->migration());
    }
}
