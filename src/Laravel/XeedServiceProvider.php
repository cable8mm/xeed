<?php

namespace Cable8mm\Xeed\Laravel;

use Cable8mm\Xeed\Laravel\Commands\GenerateDatabaseSeederCommand;
use Cable8mm\Xeed\Laravel\Commands\GenerateFactoriesCommand;
use Cable8mm\Xeed\Laravel\Commands\GenerateMigrationsCommand;
use Cable8mm\Xeed\Laravel\Commands\GenerateModelsCommand;
use Cable8mm\Xeed\Laravel\Commands\GenerateSeedersCommand;
use Cable8mm\Xeed\Laravel\Commands\ImportXeedCommand;
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
                GenerateDatabaseSeederCommand::class,
                GenerateFactoriesCommand::class,
                GenerateMigrationsCommand::class,
                GenerateModelsCommand::class,
                GenerateSeedersCommand::class,
                ImportXeedCommand::class,
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
