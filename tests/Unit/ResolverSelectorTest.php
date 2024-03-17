<?php

namespace Cable8mm\Xeed\Tests\Unit;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Resolvers\BigintResolver;
use Cable8mm\Xeed\Resolvers\BoolResolver;
use Cable8mm\Xeed\Resolvers\DatetimeResolver;
use Cable8mm\Xeed\Resolvers\DecimalResolver;
use Cable8mm\Xeed\Resolvers\EnumResolver;
use Cable8mm\Xeed\Resolvers\FloatResolver;
use Cable8mm\Xeed\Resolvers\IdResolver;
use Cable8mm\Xeed\Resolvers\IntResolver;
use Cable8mm\Xeed\Resolvers\TextResolver;
use Cable8mm\Xeed\Resolvers\TimestampResolver;
use Cable8mm\Xeed\Resolvers\VarcharResolver;
use Cable8mm\Xeed\ResolverSelector;
use PHPUnit\Framework\TestCase;

final class ResolverSelectorTest extends TestCase
{
    public function test_it_can_select_id_resolver(): void
    {
        $resolver = ResolverSelector::of(Column::make('id', 'bigint'));

        $this->assertInstanceOf(IdResolver::class, $resolver);
    }

    public function test_it_can_select_bigint_resolver(): void
    {
        $resolver = ResolverSelector::of(Column::make('column_name', 'bigint'));

        $this->assertInstanceOf(BigintResolver::class, $resolver);

        $resolver = ResolverSelector::of(Column::make('column_name', 'bigint', unsigned: true));

        $this->assertInstanceOf(BigintResolver::class, $resolver);
    }

    public function test_it_can_select_int_resolver(): void
    {
        $resolver = ResolverSelector::of(Column::make('column_name', 'int'));

        $this->assertInstanceOf(IntResolver::class, $resolver);

        $resolver = ResolverSelector::of(Column::make('column_name', 'int', unsigned: true));

        $this->assertInstanceOf(IntResolver::class, $resolver);
    }

    public function test_it_can_select_varchar_resolver(): void
    {
        $resolver = ResolverSelector::of(Column::make('column_name', 'varchar'));

        $this->assertInstanceOf(VarcharResolver::class, $resolver);

        $resolver = ResolverSelector::of(Column::make('column_name', 'varchar', notNull: true));

        $this->assertInstanceOf(VarcharResolver::class, $resolver);

        $resolver = ResolverSelector::of(Column::make('column_name', 'varchar', notNull: true, bracket: '100'));

        $this->assertInstanceOf(VarcharResolver::class, $resolver);
    }

    public function test_it_can_select_text_resolver(): void
    {
        $resolver = ResolverSelector::of(Column::make('column_name', 'text'));

        $this->assertInstanceOf(TextResolver::class, $resolver);
    }

    public function test_it_can_select_enum_resolver(): void
    {
        $resolver = ResolverSelector::of(Column::make('column_name', 'enum'));

        $this->assertInstanceOf(EnumResolver::class, $resolver);
    }

    public function test_it_can_select_datetime_resolver(): void
    {
        $resolver = ResolverSelector::of(Column::make('column_name', 'datetime'));

        $this->assertInstanceOf(DatetimeResolver::class, $resolver);

        $resolver = ResolverSelector::of(Column::make('column_name', 'datetime', notNull: true));

        $this->assertInstanceOf(DatetimeResolver::class, $resolver);
    }

    public function test_it_can_select_timestamp_resolver(): void
    {
        $resolver = ResolverSelector::of(Column::make('column_name', 'timestamp'));

        $this->assertInstanceOf(TimestampResolver::class, $resolver);
    }

    public function test_it_can_select_float_resolver(): void
    {
        $resolver = ResolverSelector::of(Column::make('column_name', 'float'));

        $this->assertInstanceOf(FloatResolver::class, $resolver);
    }

    public function test_it_can_select_boolean_resolver(): void
    {
        $resolver = ResolverSelector::of(Column::make('column_name', 'tinyint', bracket: '1'));

        $this->assertInstanceOf(BoolResolver::class, $resolver);
    }

    public function test_it_can_select_decimal_resolver(): void
    {
        $resolver = ResolverSelector::of(Column::make('column_name', 'decimal', bracket: '(11,3)'));

        $this->assertInstanceOf(DecimalResolver::class, $resolver);
    }
}
