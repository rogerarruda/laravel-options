<?php

namespace RogerArruda\LaravelOptions\Providers;

use Illuminate\Support\ServiceProvider;
use RogerArruda\LaravelOptions\Console\OptionSetCommand;
use RogerArruda\LaravelOptions\Models\Option;

class OptionsServiceProvider extends ServiceProvider
{
    protected $options;

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations/');

        $this->registerHelpers();

        if ($this->app->runningInConsole()) {
            $this->commands([
                OptionSetCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind('option', Option::class);
    }

    protected function registerHelpers()
    {
        if (file_exists($file = __DIR__ . '/../Helpers/Helpers.php'))
        {
            require $file;
        }
    }
}
