<?php

namespace Elimuswift\DbExporter;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\AliasLoader;

class DbMigrationsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('DbMigrations', 'Facades\DbMigrations');
    }

//end boot()

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton(
            DbMigrations::class,
            function() {
                $connType = Config::get('database.default');
                $database = Config::get('database.connections.' . $connType);

                return new DbMigrations($database['database']);
            }
        );
    }

//end register()

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['DbMigrations'];
    }

//end provides()
}//end class
