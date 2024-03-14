<?php

namespace Cable8mm\Xeed\Support;

final class Path
{
    public static function stub(): string
    {
        return getcwd().DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR;
    }

    public static function model(): string
    {
        return getcwd().DIRECTORY_SEPARATOR.'dist'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'Models'.DIRECTORY_SEPARATOR;
    }

    public static function seeder(): string
    {
        return getcwd().DIRECTORY_SEPARATOR.'dist'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'seeders'.DIRECTORY_SEPARATOR;
    }

    public static function factory(): string
    {
        return getcwd().DIRECTORY_SEPARATOR.'dist'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'factories'.DIRECTORY_SEPARATOR;
    }

    public static function migration(): string
    {
        return getcwd().DIRECTORY_SEPARATOR.'dist'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR;
    }
}
