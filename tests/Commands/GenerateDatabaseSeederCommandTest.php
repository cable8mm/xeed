<?php

namespace Cable8mm\Xeed\Tests\Commands;

use Orchestra\Testbench\TestCase;

class GenerateDatabaseSeederCommandTest extends TestCase
{
    public function test_execute_xeed_database_command()
    {
        $this->artisan('xeed:database')->assertSuccessful();
    }

    protected function getPackageProviders($app)
    {
        return [
            'Cable8mm\Xeed\Laravel\XeedServiceProvider',
        ];
    }
}
