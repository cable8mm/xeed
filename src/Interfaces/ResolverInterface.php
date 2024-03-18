<?php

namespace Cable8mm\Xeed\Interfaces;

/**
 * Resolver interface.
 */
interface ResolverInterface
{
    /**
     * To get the row string form database factory, then return the string for Seeder class.
     *
     * @return string Seeder class row string
     */
    public function fake(): string;

    /**
     * To get the row string for migration file, then return the string for migration class.
     *
     * @return string Migration file row string
     */
    public function migration(): string;
}
