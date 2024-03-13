<?php

namespace Cable8mm\DbToMarkdown\Test;

use Cable8mm\Xeed\Example;
use PHPUnit\Framework\TestCase;

final class ExampleTest extends TestCase
{
    public function test_example()
    {
        $this->assertEquals('1.0.0', Example::VERSION);
    }
}
