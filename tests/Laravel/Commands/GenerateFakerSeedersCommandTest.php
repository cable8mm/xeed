<?php

namespace Cable8mm\Xeed\Tests\Laravel\Commands;

class GenerateFakerSeedersCommandTest extends \Orchestra\Testbench\TestCase
{
    public function test_execute_xeed_database_command()
    {
        $this->artisan('xeed:faker-seeders')->assertSuccessful();
    }

    public function test_execute_xeed_database_command_with_table()
    {
        $this->artisan('xeed:faker-seeders -t xeeds')->assertSuccessful();
    }

    public function test_execute_xeed_database_alias_command_with_table()
    {
        $this->artisan('xeed:faker -t xeeds')->assertSuccessful();
    }

    protected function getPackageProviders($app)
    {
        return [
            'Cable8mm\Xeed\Laravel\XeedServiceProvider',
        ];
    }
}
