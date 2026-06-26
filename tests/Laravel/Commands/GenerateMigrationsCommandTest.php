<?php

namespace Cable8mm\Xeed\Tests\Laravel\Commands;

use Orchestra\Testbench\TestCase;

class GenerateMigrationsCommandTest extends TestCase
{
    public function test_execute_xeed_database_command()
    {
        $this->artisan('xeed:migrations')->assertSuccessful();
    }

    public function test_execute_xeed_database_command_with_table()
    {
        $this->artisan('xeed:migrations -t xeeds')->assertSuccessful();
    }

    protected function getPackageProviders($app)
    {
        return [
            'Cable8mm\Xeed\Laravel\XeedServiceProvider',
        ];
    }
}
