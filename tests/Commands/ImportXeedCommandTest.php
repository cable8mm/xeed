<?php

namespace Cable8mm\Xeed\Tests\Commands;

class ImportXeedCommandTest extends \Orchestra\Testbench\TestCase
{
    protected $enablesPackageDiscoveries = true;

    private string $dbDatabase;

    private string $dbDatabaseBackup;

    protected function setUp(): void
    {
        $this->dbDatabase = __DIR__.'/../../'.($_ENV['DB_DATABASE'] ?? 'tests/Generate/database.sqlite');

        $this->dbDatabaseBackup = $this->dbDatabase.'.backup';

        copy($this->dbDatabase, $this->dbDatabaseBackup);

        parent::setUp();
    }

    protected function tearDown(): void
    {
        copy($this->dbDatabaseBackup, $this->dbDatabase);

        unlink($this->dbDatabaseBackup);

        parent::tearDown();
    }

    public function test_execute_xeed_import_drop()
    {
        $this->artisan('xeed:import drop')->assertSuccessful();
    }

    public function test_execute_xeed_import()
    {
        $this->artisan('xeed:import')->assertSuccessful();
    }

    protected function getPackageProviders($app)
    {
        return [
            'Cable8mm\Xeed\Laravel\XeedServiceProvider',
        ];
    }
}
