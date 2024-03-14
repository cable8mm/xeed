<?php

namespace Cable8mm\Xeed\Interfaces;

/**
 * Generator interface.
 */
interface Generator
{
    /**
     * To run the generator logic and save it to a file.
     */
    public function run(): void;

    /**
     * Factory method.
     *
     * @param  string  $class  The name of the class for replacing with stub file
     * @param  string|null  $namespace  The namespace to be applied to the class
     * @param  string|null  $dist  The path to the dist folder
     * @return void
     */
    public static function make(
        string $class,
        ?string $namespace = null,
        ?string $dist = null
    );
}
