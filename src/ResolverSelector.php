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
     * @param  Column  $column  The column to select the resolver for
     * @return ResolverInterface The method returns the correct resolver
     *
     * @throws InvalidArgumentException
     *
     * @example ResolverSelector::of(Column::make('id', 'bigint'));
     */
    public static function of(Column $column): ResolverInterface
    {
        if ($column->field === 'id') {
            return new IdResolver($column);
        }

        foreach (self::rules() as $rule) {
            if ($rule['matches']($column)) {
                $resolver = $rule['resolver'];

                return new $resolver($column);
            }
        }

        throw new InvalidArgumentException($column.' This column cannot be resolved.');
    }

    /**
     * @return array<int, array{matches: callable(Column): bool, resolver: class-string<ResolverInterface>}>
     */
    private static function rules(): array
    {
        return [
            ['matches' => self::typeIs('bigint', 'biginteger', 'bigInteger'), 'resolver' => BigintResolver::class],
            ['matches' => self::typeIs('binary', 'bytea'), 'resolver' => BinaryResolver::class],
            ['matches' => self::typeIs('blob'), 'resolver' => BlobResolver::class],
            ['matches' => self::any(
                self::typeAndBracket('tinyint', '1'),
                self::typeIs('boolean')
            ), 'resolver' => BoolResolver::class],
            ['matches' => self::typeAndBracket('char', '26'), 'resolver' => UlidResolver::class],
            ['matches' => self::any(
                self::typeAndBracket('char', '36'),
                self::typeIs('uuid')
            ), 'resolver' => UuidResolver::class],
            ['matches' => self::typeIs('char'), 'resolver' => CharResolver::class],
            ['matches' => self::typeIs('timestamp with time zone'), 'resolver' => DateTimeTzResolver::class],
            ['matches' => self::typeIs('datetime', 'timestamp without time zone'), 'resolver' => DatetimeResolver::class],
            ['matches' => self::typeIs('date'), 'resolver' => DateResolver::class],
            ['matches' => self::typeIs('decimal'), 'resolver' => DecimalResolver::class],
            ['matches' => self::typeIs('numeric'), 'resolver' => NumericResolver::class],
            ['matches' => self::typeIs('double', 'double precision'), 'resolver' => DoubleResolver::class],
            ['matches' => self::typeIs('float', 'real'), 'resolver' => FloatResolver::class],
            ['matches' => self::typeIs('geometry', 'user-defined'), 'resolver' => GeometryResolver::class],
            ['matches' => self::typeIs('int'), 'resolver' => IntResolver::class],
            ['matches' => self::typeIs('integer', 'integer unsigned'), 'resolver' => IntegerResolver::class],
            ['matches' => self::any(
                self::typeAndBracket('varchar', '45'),
                self::typeIs('inet')
            ), 'resolver' => InetResolver::class],
            ['matches' => self::typeIs('json'), 'resolver' => JsonResolver::class],
            ['matches' => self::typeIs('jsonb'), 'resolver' => JsonbResolver::class],
            ['matches' => self::typeIs('longtext'), 'resolver' => LongtextResolver::class],
            ['matches' => self::any(
                self::typeAndBracket('varchar', '17'),
                self::typeIs('macaddr')
            ), 'resolver' => MacaddressResolver::class],
            ['matches' => self::typeIs('mediumint'), 'resolver' => MediumintResolver::class],
            ['matches' => self::typeIs('mediumtext'), 'resolver' => MediumtextResolver::class],
            ['matches' => self::fieldIs('remember_token'), 'resolver' => RemembertokenResolver::class],
            ['matches' => self::typeIs('smallint'), 'resolver' => SmallintResolver::class],
            ['matches' => self::typeIs('varchar', 'character varying', 'character'), 'resolver' => VarcharResolver::class],
            ['matches' => self::typeIs('text'), 'resolver' => TextResolver::class],
            ['matches' => self::typeIs('time', 'time without time zone'), 'resolver' => TimeResolver::class],
            ['matches' => self::typeIs('time with time zone'), 'resolver' => TimeTzResolver::class],
            ['matches' => self::typeIs('timestamp'), 'resolver' => TimestampResolver::class],
            ['matches' => self::typeIs('tinyint'), 'resolver' => TinyintResolver::class],
            ['matches' => self::typeIs('tinytext'), 'resolver' => TinytextResolver::class],
            ['matches' => self::typeIs('year'), 'resolver' => YearResolver::class],
            ['matches' => self::typeIs('enum'), 'resolver' => EnumResolver::class],
            ['matches' => self::typeIs('multilinestring'), 'resolver' => MultilinestringResolver::class],
        ];
    }

    /**
     * @param  callable(Column): bool  ...$rules
     * @return callable(Column): bool
     */
    private static function any(callable ...$rules): callable
    {
        return static function (Column $column) use ($rules): bool {
            foreach ($rules as $rule) {
                if ($rule($column)) {
                    return true;
                }
            }

            return false;
        };
    }

    /**
     * @return callable(Column): bool
     */
    private static function typeIs(string ...$types): callable
    {
        return static fn (Column $column): bool => in_array($column->type, $types, true);
    }

    /**
     * @return callable(Column): bool
     */
    private static function typeAndBracket(string $type, string $bracket): callable
    {
        return static fn (Column $column): bool => $column->type === $type && $column->bracket === $bracket;
    }

    /**
     * @return callable(Column): bool
     */
    private static function fieldIs(string ...$fields): callable
    {
        return static fn (Column $column): bool => in_array($column->field, $fields, true);
    }
}
