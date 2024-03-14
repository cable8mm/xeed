<?php

namespace Cable8mm\Xeed\Interfaces;

use Cable8mm\Xeed\DB;

interface Provider
{
    public function attach(DB $db): void;

    public static function map(array $column): array;
}
