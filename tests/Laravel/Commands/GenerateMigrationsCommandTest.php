<?php

namespace Cable8mm\Xeed\Tests\Laravel\Commands;

class GenerateMigrationsCommandTest extends \Orchestra\Testbench\TestCase
{
    public function test_execute_xeed_database_command()
    {
        $this->artisan('xeed:migrations')->assertSuccessful();
    }

    protected function getPackageProviders($app)
    {
        return [
            'Cable8mm\Xeed\Laravel\XeedServiceProvider',
        ];
    }
}
