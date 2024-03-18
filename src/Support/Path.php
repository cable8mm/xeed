<?php

namespace Cable8mm\Xeed\Support;

/**
 * Path class can help to get the various paths like root folder, stub folder, model folder and so on.
 */
final class Path
{
    /**
     * To get `stubs` folder path.
     *
     * @return string The stub folder path
     *
     * @example ./stubs/
     */
    public static function stub(): string
    {
        return getcwd().DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR;
    }

    /**
     * To get `Models` folder path.
     *
     * @return string The model folder path
     *
     * @example ./dist/app/Models/
     */
    public static function model(): string
    {
        return getcwd().DIRECTORY_SEPARATOR.'dist'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'Models'.DIRECTORY_SEPARATOR;
    }

    /**
     * To get `seeders` folder path.
     *
     * @return string The seeder folder path
     *
     * @example ./dist/database/seeders/
     */
    public static function seeder(): string
    {
        return getcwd().DIRECTORY_SEPARATOR.'dist'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'seeders'.DIRECTORY_SEPARATOR;
    }

    /**
     * To get `factory` folder path.
     *
     * @return string The factory folder path
     *
     * @example ./dist/database/factories/
     */
    public static function factory(): string
    {
        return getcwd().DIRECTORY_SEPARATOR.'dist'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'factories'.DIRECTORY_SEPARATOR;
    }

    /**
     * To get `database` folder path.
     *
     * @return string The database folder path
     *
     * @example ./database/
     */
    public static function database(): string
    {
        return getcwd().DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR;
    }

    /**
     * To get `migration` folder path.
     *
     * @return string The migration folder path
     *
     * @example ./dist/database/migrations/
     */
    public static function migration(): string
    {
        return getcwd().DIRECTORY_SEPARATOR.'dist'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR;
    }

    /**
     * To get `resource` folder path.
     *
     * @return string The resource folder path
     *
     * @example ./resources/
     */
    public static function resource(): string
    {
        return getcwd().DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR;
    }
}
