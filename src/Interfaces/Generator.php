<?php

namespace Cable8mm\Xeed\Interfaces;

interface Generator
{
    public function run(): void;

    public static function make(
        string $class,
        ?string $namespace = null,
        ?string $dist = null
    );
}
