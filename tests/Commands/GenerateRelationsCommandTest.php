<?php

namespace Cable8mm\Xeed\Tests\Commands;

class GenerateRelationsCommandTest extends \Orchestra\Testbench\TestCase
{
    public function test_execute_xeed_relations_command()
    {
        $this->artisan('xeed:relation')->assertSuccessful();
    }

    public function test_execute_xeed_relations_command_with_models()
    {
        $this->artisan('xeed:relation -f')->assertSuccessful();
    }

    protected function getPackageProviders($app)
    {
        return [
            'Cable8mm\Xeed\Laravel\XeedServiceProvider',
        ];
    }
}
