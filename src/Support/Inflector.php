<?php

namespace Cable8mm\Xeed\Support;

use Doctrine\Inflector\Inflector as DoctrineInflector;
use Doctrine\Inflector\InflectorFactory;

/**
 * Path class can help to get the various paths like root folder, stub folder, model folder and so on.
 */
final class Inflector
{
    /**
     * Singleton Instance.
     */
    private static ?DoctrineInflector $inflector = null;

    /**
     * Get Class name as Laravel style.
     *
     * @param  string  $string  raw table name
     * @return string The method returns Model class name as Laravel style
     */
    public static function classify(string $string): string
    {
        if (self::$inflector === null) {
            self::$inflector = InflectorFactory::create()->build();
        }

        return self::$inflector->singularize(self::$inflector->classify($string));
    }

    /**
     * Get Class name as hasMany method name.
     *
     * @param  string  $string  raw Class name
     * @return string The method returns hasMany method name
     */
    public static function pluralize(string $string): string
    {
        if (self::$inflector === null) {
            self::$inflector = InflectorFactory::create()->build();
        }

        return self::$inflector->pluralize(self::$inflector->tableize($string));
    }

    /**
     * Get Class name as belongsTo method name.
     *
     * @param  string  $string  raw Class name
     * @return string The method returns belongsTo method name
     */
    public static function tableize(string $string): string
    {
        if (self::$inflector === null) {
            self::$inflector = InflectorFactory::create()->build();
        }

        return self::$inflector->tableize($string);
    }
}
