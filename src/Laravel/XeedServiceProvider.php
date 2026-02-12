<?php

namespace Cable8mm\Xeed\Laravel;

use Cable8mm\Xeed\Commands\CleanCommand;
use Cable8mm\Xeed\Commands\GenerateDatabaseSeederCommand;
use Cable8mm\Xeed\Commands\GenerateFactoriesCommand;
use Cable8mm\Xeed\Commands\GenerateFakerSeedersCommand;
use Cable8mm\Xeed\Commands\GenerateMigrationsCommand;
use Cable8mm\Xeed\Commands\GenerateModelsCommand;
use Cable8mm\Xeed\Commands\GenerateNovaCommand;
use Cable8mm\Xeed\Commands\GenerateRelationsCommand;
use Cable8mm\Xeed\Commands\GenerateSeedersCommand;
use Cable8mm\Xeed\Commands\ImportXeedCommand;
use Cable8mm\Xeed\Xeed;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class XeedServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // php artisan vendor:publish --tag=xeed-sql
        if ($this->app->runningInConsole()) {
            $this->commands([
                CleanCommand::class,
                GenerateDatabaseSeederCommand::class,
                GenerateFactoriesCommand::class,
                GenerateMigrationsCommand::class,
                GenerateModelsCommand::class,
                GenerateSeedersCommand::class,
                GenerateFakerSeedersCommand::class,
                GenerateRelationsCommand::class,
                ImportXeedCommand::class,
                GenerateNovaCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton(Xeed::class, function () {
            return Xeed::make();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return [Xeed::class];
    }
}
