<?php

namespace Cable8mm\Xeed;

use Cable8mm\Xeed\Interfaces\ResolverInterface;
use Cable8mm\Xeed\Resolvers\BigintResolver;
use Cable8mm\Xeed\Resolvers\BinaryResolver;
use Cable8mm\Xeed\Resolvers\BlobResolver;
use Cable8mm\Xeed\Resolvers\BoolResolver;
use Cable8mm\Xeed\Resolvers\CharResolver;
use Cable8mm\Xeed\Resolvers\DateResolver;
use Cable8mm\Xeed\Resolvers\DatetimeResolver;
use Cable8mm\Xeed\Resolvers\DateTimeTzResolver;
use Cable8mm\Xeed\Resolvers\DecimalResolver;
use Cable8mm\Xeed\Resolvers\DoubleResolver;
use Cable8mm\Xeed\Resolvers\EnumResolver;
use Cable8mm\Xeed\Resolvers\FloatResolver;
use Cable8mm\Xeed\Resolvers\GeometryResolver;
use Cable8mm\Xeed\Resolvers\IdResolver;
use Cable8mm\Xeed\Resolvers\InetResolver;
use Cable8mm\Xeed\Resolvers\IntegerResolver;
use Cable8mm\Xeed\Resolvers\IntResolver;
use Cable8mm\Xeed\Resolvers\JsonbResolver;
use Cable8mm\Xeed\Resolvers\JsonResolver;
use Cable8mm\Xeed\Resolvers\LongtextResolver;
use Cable8mm\Xeed\Resolvers\MacaddressResolver;
use Cable8mm\Xeed\Resolvers\MediumintResolver;
use Cable8mm\Xeed\Resolvers\MediumtextResolver;
use Cable8mm\Xeed\Resolvers\MultilinestringResolver;
use Cable8mm\Xeed\Resolvers\NumericResolver;
use Cable8mm\Xeed\Resolvers\RemembertokenResolver;
use Cable8mm\Xeed\Resolvers\SmallintResolver;
use Cable8mm\Xeed\Resolvers\TextResolver;
use Cable8mm\Xeed\Resolvers\TimeResolver;
use Cable8mm\Xeed\Resolvers\TimestampResolver;
use Cable8mm\Xeed\Resolvers\TimeTzResolver;
use Cable8mm\Xeed\Resolvers\TinyintResolver;
use Cable8mm\Xeed\Resolvers\TinytextResolver;
use Cable8mm\Xeed\Resolvers\UlidResolver;
use Cable8mm\Xeed\Resolvers\UuidResolver;
use Cable8mm\Xeed\Resolvers\VarcharResolver;
use Cable8mm\Xeed\Resolvers\YearResolver;
use InvalidArgumentException;

/**
 * The resolver to select selector class for the given column.
 */
final class ResolverSelector
{
    /**
     * Select the resolver for the given column.
     *
     * @param  \Cable8mm\Xeed\Column  $column  The column to select the resolver for
     * @return ResolverInterface The method returns the correct resolver
     *
     * @throws InvalidArgumentException
     *
     * @example ResolverSelector::of(Column::make('id', 'bigint'));
     */
    public static function of(Column $column): ResolverInterface
    {
        if ($column->field == 'id') {
            return new IdResolver($column);
        }

        if ($column->type == 'bigint' || $column->type == 'biginteger' || $column->type == 'bigInteger') {
            return new BigintResolver($column);
        }

        if ($column->type == 'binary' || $column->type == 'bytea') {
            return new BinaryResolver($column);
        }

        if ($column->type == 'blob') {
            return new BlobResolver($column);
        }

        if (($column->type == 'tinyint' && $column->bracket == '1') || $column->type == 'boolean') {
            return new BoolResolver($column);
        }

        if ($column->type == 'char' && $column->bracket == '26') {
            return new UlidResolver($column);
        }

        if (($column->type == 'char' && $column->bracket == '36') || $column->type == 'uuid') {
            return new UuidResolver($column);
        }

        if ($column->type == 'char') {
            return new CharResolver($column);
        }

        if ($column->type == 'timestamp with time zone') {
            return new DateTimeTzResolver($column);
        }

        if ($column->type == 'datetime' || $column->type == 'timestamp without time zone') {
            return new DatetimeResolver($column);
        }

        if ($column->type == 'date') {
            return new DateResolver($column);
        }

        if ($column->type == 'decimal') {
            return new DecimalResolver($column);
        }

        if ($column->type == 'numeric') {
            return new NumericResolver($column);
        }

        if ($column->type == 'double' || $column->type == 'double precision') {
            return new DoubleResolver($column);
        }

        if ($column->type == 'float' || $column->type == 'real') {
            return new FloatResolver($column);
        }

        if ($column->type == 'geometry' || $column->type == 'user-defined') {
            return new GeometryResolver($column);
        }

        if ($column->type == 'int') {
            return new IntResolver($column);
        }

        if ($column->type == 'integer' || $column->type == 'integer unsigned') {
            return new IntegerResolver($column);
        }

        if (($column->type == 'varchar' && $column->bracket == '45') || $column->type == 'inet') {
            return new InetResolver($column);
        }

        if ($column->type == 'json') {
            return new JsonResolver($column);
        }

        if ($column->type == 'jsonb') {
            return new JsonbResolver($column);
        }

        if ($column->type == 'longtext') {
            return new LongtextResolver($column);
        }

        if (($column->type == 'varchar' && $column->bracket == '17') || $column->type == 'macaddr') {
            return new MacaddressResolver($column);
        }

        if ($column->type == 'mediumint') {
            return new MediumintResolver($column);
        }

        if ($column->type == 'mediumtext') {
            return new MediumtextResolver($column);
        }

        if ($column->field == 'remember_token') {
            return new RemembertokenResolver($column);
        }

        if ($column->type == 'smallint') {
            return new SmallintResolver($column);
        }

        if ($column->type == 'varchar' || $column->type == 'character varying' || $column->type == 'character') {
            return new VarcharResolver($column);
        }

        if ($column->type == 'text') {
            return new TextResolver($column);
        }

        if ($column->type == 'time' || $column->type == 'time without time zone') {
            return new TimeResolver($column);
        }

        if ($column->type == 'time with time zone') {
            return new TimeTzResolver($column);
        }

        if ($column->type == 'timestamp') {
            return new TimestampResolver($column);
        }

        if ($column->type == 'tinyint') {
            return new TinyintResolver($column);
        }

        if ($column->type == 'tinytext') {
            return new TinytextResolver($column);
        }

        if ($column->type == 'year') {
            return new YearResolver($column);
        }

        if ($column->type == 'enum') {
            return new EnumResolver($column);
        }

        if ($column->type == 'multilinestring') {
            return new MultilinestringResolver($column);
        }

        throw new InvalidArgumentException($column.' This column cannot be resolved.');
    }
}
