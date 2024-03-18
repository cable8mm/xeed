<?php

namespace Cable8mm\Xeed\Tests\Unit\Support;

use Cable8mm\Xeed\Types\Bracket;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class BracketTest extends TestCase
{
    public Bracket $bracket;

    public function test_it_can_parse_left_with_bracket(): void
    {
        $bracket = Bracket::of('(8, 2)');

        $this->assertEquals('8', $bracket->left);
    }

    public function test_it_can_parse_right_with_bracket(): void
    {
        $bracket = Bracket::of('(8, 2)');

        $this->assertEquals('2', $bracket->right);
    }

    public function test_it_can_parse_left_with_space(): void
    {
        $bracket = Bracket::of('int unsigned');

        $this->assertEquals('int', $bracket->left);
    }

    public function test_it_can_parse_right_with_space(): void
    {
        $bracket = Bracket::of('int unsigned');

        $this->assertEquals('unsigned', $bracket->right);
    }

    public function test_it_can_parse_string(): void
    {
        $bracket = Bracket::of('int');

        $this->assertEquals('int', $bracket);
    }

    public function test_it_can_not_parse_left(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Bracket::of('int')->left;
    }

    public function test_it_can_not_parse_right(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Bracket::of('int')->right;
    }

    public function test_it_can_not_parse_array(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Bracket::of('int unsigned')->value;
    }
}
