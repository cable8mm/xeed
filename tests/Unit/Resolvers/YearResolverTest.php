<?php

namespace Cable8mm\Xeed\Tests\Unit\Resolvers;

use Cable8mm\Xeed\DB;
use Cable8mm\Xeed\Resolvers\YearResolver;
use Cable8mm\Xeed\Support\Picker;
use PHPUnit\Framework\TestCase;

final class YearResolverTest extends TestCase
{
    public ?YearResolver $resolver = null;

    protected function setUp(): void
    {
        $db = DB::getInstance();

        if ($db->driver === 'mysql') {
            $column = Picker::of($db->attach()
                ->getTable('xeeds')
                ->getColumns()
            )->driver($db->driver)->type('year')->get();

            $this->resolver = new YearResolver($column);
        }
    }

    public function test_fake_method_can_working_well(): void
    {
        if ($this->resolver !== null) {
            $this->assertEquals('\'birth_year\' => fake()->year(),', $this->resolver->fake());
        }

        $this->assertTrue(true);
    }

    public function test_migration_method_can_working_well(): void
    {
        if ($this->resolver !== null) {
            $this->assertEquals('$table->year(\'birth_year\');', $this->resolver->migration());
        }

        $this->assertTrue(true);
    }
}
