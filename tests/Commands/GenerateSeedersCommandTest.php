<?php

namespace Cable8mm\Xeed\Tests\Commands;

class GenerateSeedersCommandTest extends \Orchestra\Testbench\TestCase
{
    public function test_execute_xeed_database_command()
    {
        $this->artisan('xeed:seeder')->assertSuccessful();
    }

    public function test_execute_xeed_database_command_with_table()
    {
        $this->artisan('xeed:seeder xeeds')->assertSuccessful();
    }

    public function test_execute_xeed_database_command_with_table_forced()
    {
        $this->artisan('xeed:seeder xeeds -f')->assertSuccessful();
    }

    protected function getPackageProviders($app)
    {
        return [
            'Cable8mm\Xeed\Laravel\XeedServiceProvider',
        ];
    }
}
