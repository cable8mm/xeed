<?php

namespace Cable8mm\Xeed\Tests\Laravel\Commands;

use Orchestra\Testbench\TestCase;

class ImportXeedCommandTest extends TestCase
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
