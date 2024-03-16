<?php

namespace Cable8mm\Xeed\Tests\Unit\Resolvers;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\DB;
use Cable8mm\Xeed\Resolvers\MultipointResolver;
use Cable8mm\Xeed\Support\Picker;
use PHPUnit\Framework\TestCase;

final class MultipointResolverTest extends TestCase
{
    public Column $column;

    protected function setUp(): void
    {
        $db = DB::getInstance();

        $this->column = Picker::of($db->attach()
            ->getTable('xeeds')
            ->getColumns()
        )->driver($db->driver)->field('multi_point')->get();
    }

    public function test_column_can_not_null(): void
    {
        $this->assertNotNull($this->column);
    }

    public function test_resolver_can_be_created(): void
    {
        $resolver = new MultipointResolver($this->column);

        $this->assertNotNull($resolver);
    }

    public function test_fake_method_can_working_well(): void
    {
        $resolver = new MultipointResolver($this->column);

        $this->assertEquals('\''.$resolver->field.'\' => \'MULTIPOINT(0 0, 20 20, 60 60)\',', $resolver->fake());
    }

    public function test_migration_method_can_working_well(): void
    {
        $resolver = new MultipointResolver($this->column);

        $this->assertEquals('$table->multiPoint(\''.$resolver->field.'\');', $resolver->migration());
    }
}
