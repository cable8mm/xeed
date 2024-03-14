<?php

namespace Cable8mm\Xeed\Traits;

trait SeederGeneratorMakable
{
    /**
     * Factory method.
     *
     * @param  string  $class  The model class name
     * @param  string  $namespace  The model namespace
     * @param  string  $dist  The path to the dist folder
     */
    public static function make(
        string $class,
        ?string $namespace = null,
        ?string $dist = __DIR__.'/../../dist/'
    ): static {
        return new self($class, $namespace, $dist);
    }
}
