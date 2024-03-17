<?php

namespace Cable8mm\Xeed\Interfaces;

/**
 * Resolver interface.
 */
interface ResolverInterface
{
    /**
     * To get the row string form database factory.
     *
     * @return string The row string for factory method.
     */
    public function fake(): string;

    /**
     * To get the row string for migration file.
     *
     * @return string The row string for migration file.
     */
    public function migration(): string;
}
