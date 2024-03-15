<?php

namespace Cable8mm\Xeed\Tests\Unit\Resolvers;

use Cable8mm\Xeed\DB;
use Cable8mm\Xeed\Resolvers\YearResolver;
use Cable8mm\Xeed\Support\Picker;
use PHPUnit\Framework\TestCase;

final class YearResolverTest extends TestCase
{
    public YearResolver $resolver;

    protected function setUp(): void
    {
        $db = DB::getInstance();
        $column = Picker::of($db->attach()
            ->getTable('xeeds')
            ->getColumns()
        )->driver($db->driver)->type('year');

        $this->resolver = new YearResolver($column);

    }

    public function test_fake_method_can_working_well(): void
    {
        $this->assertEquals('\''.$this->resolver->field.'\' => fake()->year(),', $this->resolver->fake());
    }

    public function test_migration_method_can_working_well(): void
    {
        $this->assertEquals('$table->year(\''.$this->resolver->field.'\');', $this->resolver->migration());
    }
}
