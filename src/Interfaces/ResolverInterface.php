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

    /**
     * Get the row string for Nova resource file, then return the string for Nova resource class.
     *
     * @return string The method returns a Nova resource file row field string
     */
    public function nova(): ?string;

    /**
     * Get the row string for cast file, then return the string for cast class.
     *
     * @return string The method returns a cast file row field string
     */
    public function cast(): ?string;
}
