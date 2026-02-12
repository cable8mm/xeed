<?php

namespace Cable8mm\Xeed\Tests\Commands;

class GenerateFactoriesCommandTest extends \Orchestra\Testbench\TestCase
{
    public function test_execute_xeed_database_command()
    {
        $this->artisan('xeed:factory')->assertSuccessful();
    }

    public function test_execute_xeed_database_command_with_table()
    {
        $this->artisan('xeed:factory xeeds')->assertSuccessful();
    }

    public function test_execute_xeed_database_command_with_table_forced()
    {
        $this->artisan('xeed:factory xeeds -f')->assertSuccessful();
    }

    protected function getPackageProviders($app)
    {
        return [
            'Cable8mm\Xeed\Laravel\XeedServiceProvider',
        ];
    }
}
