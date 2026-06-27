<?php

namespace Cable8mm\Xeed\Tests\Commands;

use Illuminate\Support\Facades\DB;
use Orchestra\Testbench\TestCase;

class ImportXeedCommandTest extends TestCase
{
    protected $enablesPackageDiscoveries = true;

    private string $dbDatabase;

    private ?string $previousDefaultConnection = null;

    private ?string $previousSqliteDatabase = null;

    private ?string $previousDbConnectionEnv = null;

    private ?string $previousDbDatabaseEnv = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->previousDefaultConnection = config('database.default');
        $this->previousSqliteDatabase = config('database.connections.sqlite.database');
        $this->previousDbConnectionEnv = $_ENV['DB_CONNECTION'] ?? null;
        $this->previousDbDatabaseEnv = $_ENV['DB_DATABASE'] ?? null;

        $this->dbDatabase = tempnam(sys_get_temp_dir(), 'xeed-').'.sqlite';

        touch($this->dbDatabase);

        $this->useTemporarySqliteDatabase($this->dbDatabase);
    }

    protected function tearDown(): void
    {
        config()->set('database.default', $this->previousDefaultConnection);
        config()->set('database.connections.sqlite.database', $this->previousSqliteDatabase);

        if ($this->previousDbConnectionEnv === null) {
            unset($_ENV['DB_CONNECTION']);
        } else {
            $_ENV['DB_CONNECTION'] = $this->previousDbConnectionEnv;
        }

        if ($this->previousDbDatabaseEnv === null) {
            unset($_ENV['DB_DATABASE']);
        } else {
            $_ENV['DB_DATABASE'] = $this->previousDbDatabaseEnv;
        }

        DB::purge('sqlite');

        if (is_file($this->dbDatabase)) {
            unlink($this->dbDatabase);
        }

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

    private function useTemporarySqliteDatabase(string $database): void
    {
        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite.database', $database);

        $_ENV['DB_CONNECTION'] = 'sqlite';
        $_ENV['DB_DATABASE'] = $database;

        DB::purge('sqlite');
        DB::reconnect('sqlite');
    }

    protected function getPackageProviders($app)
    {
        return [
            'Cable8mm\Xeed\Laravel\XeedServiceProvider',
        ];
    }
}
