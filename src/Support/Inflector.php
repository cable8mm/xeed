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

    public static function classify(string $string): string
    {
        if (self::$inflector === null) {
            self::$inflector = InflectorFactory::create()->build();
        }

        return self::$inflector->singularize(self::$inflector->classify($string));
    }
}
