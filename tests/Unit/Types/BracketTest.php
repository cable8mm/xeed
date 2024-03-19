<?php

namespace Cable8mm\Xeed\Tests\Unit\Types;

use Cable8mm\Xeed\Types\Bracket;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class BracketTest extends TestCase
{
    public Bracket $bracket;

    public function test_it_can_parse_left_with_bracket(): void
    {
        $bracket = Bracket::of('(8, 2)');

        $this->assertEquals('8', $bracket->left());
    }

    public function test_it_can_parse_right_with_bracket(): void
    {
        $bracket = Bracket::of('(8, 2)');

        $this->assertEquals('2', $bracket->right());
    }

    public function test_it_can_parse_left_with_space(): void
    {
        $bracket = Bracket::of('int unsigned');

        $this->assertEquals('int', $bracket->left());
    }

    public function test_it_can_parse_right_with_space(): void
    {
        $bracket = Bracket::of('int unsigned');

        $this->assertEquals('unsigned', $bracket->right());
    }

    public function test_it_can_parse_string(): void
    {
        $bracket = Bracket::of('int');

        $this->assertEquals('int', $bracket);
    }

    public function test_it_can_not_parse_left(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Bracket::of('int')->left();
    }

    public function test_it_can_not_parse_right(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Bracket::of('int')->right();
    }

    public function test_it_can_not_parse_array(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Bracket::of('int unsigned')->to();
    }

    public function test_it_can_escape(): void
    {
        $this->assertEquals(
            '8, 2',
            Bracket::of('(8, 2)')->escape()
        );
    }

    public function test_it_can_process_null(): void
    {
        $this->assertNotNull(
            Bracket::of(null)->to(0)
        );
    }
}
