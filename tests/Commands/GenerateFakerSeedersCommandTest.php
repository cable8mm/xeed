<?php

namespace Cable8mm\Xeed\Tests\Commands;

class GenerateFakerSeedersCommandTest extends \Orchestra\Testbench\TestCase
{
    public function test_execute_xeed_database_command()
    {
        $this->artisan('xeed:faker-seeder')->assertSuccessful();
    }

    public function test_execute_xeed_database_command_with_table()
    {
        $this->artisan('xeed:faker-seeder xeeds')->assertSuccessful();
    }

    public function test_execute_xeed_database_command_with_table_forced()
    {
        $this->artisan('xeed:faker-seeder xeeds -f')->assertSuccessful();
    }

    public function test_execute_xeed_database_alias_command_with_table()
    {
        $this->artisan('xeed:faker xeeds')->assertSuccessful();
    }

    protected function getPackageProviders($app)
    {
        return [
            'Cable8mm\Xeed\Laravel\XeedServiceProvider',
        ];
    }
}
