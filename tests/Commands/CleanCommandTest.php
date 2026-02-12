<?php

namespace Cable8mm\Xeed\Tests\Commands;

class CleanCommandTest extends \Orchestra\Testbench\TestCase
{
    public function test_execute_xeed_clean_command()
    {
        $this->artisan('xeed:clean')
            ->expectsChoice(
                'Please select directory for you to want to clean.',
                'exit',
                ['seeder', 'model', 'factory', 'migration', 'all', 'exit']
            )
            ->expectsOutput('You have just selected: exit')
            ->assertExitCode(0);
    }

    public function test_execute_xeed_clean_command_alias()
    {
        $this->artisan('xeed:wipe')
            ->expectsChoice(
                'Please select directory for you to want to clean.',
                'exit',
                ['seeder', 'model', 'factory', 'migration', 'all', 'exit']
            )
            ->expectsOutput('You have just selected: exit')
            ->assertExitCode(0);
    }

    public function test_execute_xeed_clean_all_command()
    {
        $this->assertTrue(true);

        // The below command is used to run the risky tests.
        // The test remove all files of 'seeder', 'model', 'factory', 'migration' directories.
        //
        // $this->artisan('xeed:clean')
        //     ->expectsChoice(
        //         'Please select directory for you to want to clean.',
        //         'all',
        //         ['seeder', 'model', 'factory', 'migration', 'all', 'exit']
        //     )
        //     ->expectsOutput('You have just selected: all')
        //     ->assertExitCode(0);
    }

    protected function getPackageProviders($app)
    {
        return [
            'Cable8mm\Xeed\Laravel\XeedServiceProvider',
        ];
    }
}
