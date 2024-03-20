<?php

namespace Cable8mm\Xeed\Interfaces;

/**
 * Resolver interface.
 */
interface ResolverInterface
{
    /**
     * Get the row string form database factory, then return the string for Seeder class.
     *
     * @return string The method returns a Seeder class row string
     */
    public function fake(): string;

    /**
     * Get the row string for migration file, then return the string for migration class.
     *
     * @return string The method returns a Migration file row string
     */
    public function migration(): string;
}
