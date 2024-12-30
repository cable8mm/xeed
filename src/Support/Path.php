<?php

namespace Cable8mm\Xeed\Support;

/**
 * Path class can help to get the various paths like root folder, stub folder, model folder and so on.
 */
final class Path
{
    /**
     * Get `stubs` folder path.
     *
     * @return string The stub folder path
     *
     * @example ./stubs/
     */
    public static function stub(): string
    {
        return realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'stubs');
    }

    /**
     * Get `Models` folder path.
     *
     * @return string The model folder path
     *
     * @example ./dist/app/Models/
     */
    public static function model(): string
    {
        return realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'dist'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'Models');
    }

    /**
     * Get `Models` folder path.
     *
     * @return string The model folder path
     *
     * @example ./dist/app/Nova/
     */
    public static function nova(): string
    {
        return realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'dist'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'Nova');
    }

    /**
     * Get `seeders` folder path.
     *
     * @return string The seeder folder path
     *
     * @example ./dist/database/seeders/
     */
    public static function seeder(): string
    {
        return realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'dist'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'seeders');
    }

    /**
     * Get `factory` folder path.
     *
     * @return string The factory folder path
     *
     * @example ./dist/database/factories/
     */
    public static function factory(): string
    {
        return realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'dist'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'factories');
    }

    /**
     * Get `database` folder path.
     *
     * @return string The database folder path
     *
     * @example ./database/
     */
    public static function database(): string
    {
        return realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'database');
    }

    /**
     * Get `migration` folder path.
     *
     * @return string The migration folder path
     *
     * @example ./dist/database/migrations/
     */
    public static function migration(): string
    {
        return realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'dist'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations');
    }

    /**
     * Get `resource` folder path.
     *
     * @return string The resource folder path
     *
     * @example ./resources/
     */
    public static function resource(): string
    {
        return realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'resources');
    }

    /**
     * Get `root` folder path.
     *
     * @return string The root folder path
     */
    public static function root(): string
    {
        return realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..');
    }

    /**
     * Get `tests/Bootstrap` folder path.
     *
     * @return string The tests/Bootstrap folder path.
     */
    public static function testBootstrap(): string
    {
        return realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'tests'.DIRECTORY_SEPARATOR.'Bootstrap');
    }

    /**
     * Get `tests/Generate` folder path.
     *
     * @internal Don't use this method except testing.
     *
     * @return string This method returns the `tests/Generate` folder path for testing.
     */
    public static function testgen(): string
    {
        return realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'tests'.DIRECTORY_SEPARATOR.'Generate');
    }

    /**
     * Get `tests/Expected` folder path.
     *
     * @internal Don't use this method except testing.
     *
     * @return string This method returns the `tests/Expected` folder path for testing.
     */
    public static function testExpected(): string
    {
        return realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'tests'.DIRECTORY_SEPARATOR.'Expected');
    }
}
