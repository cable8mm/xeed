<?php

namespace Cable8mm\Xeed\Tests\Unit\Support;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\Support\Picker;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class PickerTest extends TestCase
{
    public Picker $picker;

    protected function setUp(): void
    {
        $this->picker = Picker::of(
            [
                new Column('id', 'integer'),
                new Column('name', 'string'),
            ]
        );
    }

    public function test_it_can_pick_a_column(): void
    {
        $this->assertInstanceOf(Picker::class, $this->picker);

        $this->assertInstanceOf(Column::class, $this->picker->toArray()[0]);
        $this->assertInstanceOf(Column::class, $this->picker->toArray()[1]);
    }

    public function test_driver_method_works_correctly(): void
    {
        $this->picker->driver('mysql');

        $this->assertEquals('mysql', $this->picker->getDriver());
    }

    public function test_type_method_works_correctly(): void
    {
        $this->assertEquals('id', $this->picker->get(driver: 'mysql', type: 'integer')->field);
        $this->assertEquals('integer', $this->picker->get(driver: 'mysql', type: 'integer')->type);
    }

    public function test_get_method_works_correctly(): void
    {
        $this->assertEquals('id', $this->picker->driver('mysql')->get(type: 'integer')->field);
        $this->assertEquals('name', $this->picker->driver('mysql')->get(field: 'name')->field);
        $this->assertEquals('name', $this->picker->driver('mysql')->get(field: 'name', type: 'string')->field);

        $this->assertNull($this->picker->driver('mysql')->get(type: 'wrong_type'));
        $this->assertNull($this->picker->driver('mysql')->get(field: 'wrong_field'));
    }

    public function test_it_must_throw_an_exception_when_driver_is_not_found(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->picker->get();
    }

    public function test_it_must_throw_an_exception_when_no_field_and_name_is_not_found(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->picker->driver('mysql')->get();
    }
}
