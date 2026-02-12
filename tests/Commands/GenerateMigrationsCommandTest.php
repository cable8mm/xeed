<?php

namespace Cable8mm\Xeed\Tests\Commands;

class GenerateMigrationsCommandTest extends \Orchestra\Testbench\TestCase
{
    public function test_execute_xeed_database_command()
    {
        $this->artisan('xeed:migration')->assertSuccessful();
    }

    public function test_execute_xeed_database_command_with_table()
    {
        $this->artisan('xeed:migration xeeds')->assertSuccessful();
    }

    public function test_execute_xeed_database_command_with_table_forced()
    {
        $this->artisan('xeed:migration xeeds --force')->assertSuccessful();
    }

    protected function getPackageProviders($app)
    {
        return [
            'Cable8mm\Xeed\Laravel\XeedServiceProvider',
        ];
    }
}
