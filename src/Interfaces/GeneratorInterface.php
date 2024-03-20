<?php

namespace Cable8mm\Xeed\Interfaces;

use Cable8mm\Xeed\Table;

/**
 * Generator interface.
 */
interface GeneratorInterface
{
    /**
     * Run the generator logic and save it to a file.
     *
     * @param  bool  $force  Whether to force the generation of the generator file or not.
     */
    public function run(bool $force = false): void;

    /**
     * Create a singleton instance.
     *
     * @param  \Cable8mm\Xeed\Table  $class  The name of the class for replacing with stub file
     * @param  string|null  $namespace  The namespace to be applied to the class
     * @param  string|null  $destination  The path to the dist folder
     * @return void
     */
    public static function make(
        Table $class,
        ?string $namespace = null,
        ?string $destination = null
    );
}
