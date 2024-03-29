<?php

namespace Cable8mm\Xeed\Tests\Laravel\Commands;

class GenerateModelsCommandTest extends \Orchestra\Testbench\TestCase
{
    public function test_execute_xeed_database_command()
    {
        $this->artisan('xeed:models')->assertSuccessful();
    }

    public function test_execute_xeed_database_command_with_table()
    {
        $this->artisan('xeed:models -t xeeds')->assertSuccessful();
    }

    protected function getPackageProviders($app)
    {
        return [
            'Cable8mm\Xeed\Laravel\XeedServiceProvider',
        ];
    }
}
