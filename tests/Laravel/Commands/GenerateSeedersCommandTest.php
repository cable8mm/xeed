<?php

namespace Cable8mm\Xeed\Tests\Laravel\Commands;

class GenerateSeedersCommandTest extends \Orchestra\Testbench\TestCase
{
    public function test_execute_xeed_database_command()
    {
        $this->artisan('xeed:seeders')->assertSuccessful();
    }

    protected function getPackageProviders($app)
    {
        return [
            'Cable8mm\Xeed\Laravel\XeedServiceProvider',
        ];
    }
}
