<?php

namespace Cable8mm\Xeed\Resolvers;

use Cable8mm\Xeed\Column;

final class ResolverSelector
{
    public static function of(Column $column): Resolver
    {
        if ($column->field == 'id') {
            return new IdResolver($column);
        }

        if ($column->type == 'bigint') {
            return new BigintResolver($column);
        }

        if ($column->type == 'blob') {
            return new BlobResolver($column);
        }

        if ($column->type == 'tinyint' && $column->bracket == '1') {
            return new BoolResolver($column);
        }

        if ($column->type == 'char' && $column->bracket == '26') {
            return new UlidResolver($column);
        }

        if ($column->type == 'char' && $column->bracket == '36') {
            return new UuidResolver($column);
        }

        if ($column->type == 'char') {
            return new CharResolver($column);
        }

        if ($column->type == 'datetime') {
            return new DatetimeResolver($column);
        }

        if ($column->type == 'date') {
            return new DateResolver($column);
        }

        if ($column->type == 'decimal') {
            return new DecimalResolver($column);
        }

        if ($column->type == 'double') {
            return new DoubleResolver($column);
        }

        if ($column->type == 'float') {
            return new FloatResolver($column);
        }

        if ($column->type == 'geomcollection') {
            return new GeometrycollectionResolver($column);
        }

        if ($column->type == 'geometry') {
            return new GeometryResolver($column);
        }

        if ($column->type == 'int') {
            return new IntResolver($column);
        }

        if ($column->type == 'varchar' && $column->bracket == '45') {
            return new InetResolver($column);
        }

        if ($column->type == 'json') {
            return new JsonResolver($column);
        }

        if ($column->type == 'jsonb') {
            return new JsonbResolver($column);
        }

        if ($column->type == 'linestring') {
            return new LineStringResolver($column);
        }

        if ($column->type == 'longtext') {
            return new LongtextResolver($column);
        }

        if ($column->type == 'varchar' && $column->bracket == '17') {
            return new MacaddressResolver($column);
        }

        if ($column->type == 'mediumint') {
            return new MediumintResolver($column);
        }

        if ($column->type == 'mediumtext') {
            return new MediumtextResolver($column);
        }

        if ($column->type == 'multipoint') {
            return new MultipointResolver($column);
        }

        if ($column->type == 'multipolygon') {
            return new MultipolygonResolver($column);
        }

        if ($column->type == 'point') {
            return new PointResolver($column);
        }

        if ($column->type == 'polygon') {
            return new PolygonResolver($column);
        }

        if ($column->field == 'remember_token') {
            return new RemembertokenResolver($column);
        }

        if ($column->type == 'set') {
            return new SetResolver($column);
        }

        if ($column->type == 'smallint') {
            return new SmallintResolver($column);
        }

        if ($column->type == 'varchar') {
            return new VarcharResolver($column);
        }

        if ($column->type == 'text') {
            return new TextResolver($column);
        }

        if ($column->type == 'time') {
            return new TimeResolver($column);
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
    }
}
