<?php

namespace Cable8mm\Xeed\Tests\Laravel\Commands;

use Orchestra\Testbench\TestCase;

class GenerateSeedersCommandTest extends TestCase
{
    public function test_execute_xeed_database_command()
    {
        $this->artisan('xeed:seeders')->assertSuccessful();
    }

    public function test_execute_xeed_database_command_with_table()
    {
        $this->artisan('xeed:seeders -t xeeds')->assertSuccessful();
    }

    protected function getPackageProviders($app)
    {
        return [
            'Cable8mm\Xeed\Laravel\XeedServiceProvider',
        ];
    }
}
