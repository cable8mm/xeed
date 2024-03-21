<?php

namespace Cable8mm\Xeed\Tests\Laravel\Commands;

class ImportXeedCommandTest extends \Orchestra\Testbench\TestCase
{
    protected $enablesPackageDiscoveries = true;

    public function test_execute_xeed_import()
    {
        $this->artisan('xeed:import')->assertSuccessful();
    }

    public function test_execute_xeed_import_drop()
    {
        $this->artisan('xeed:import drop')->assertSuccessful();
    }

    protected function getPackageProviders($app)
    {
        return [
            'Cable8mm\Xeed\Laravel\XeedServiceProvider',
        ];
    }
}
