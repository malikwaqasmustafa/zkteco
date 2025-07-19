<?php

namespace maliklibs\Zkteco\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class ZktecoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/zkteco.php', 'zkteco'
        );

        $this->app->singleton('zkteco', function ($app) {
            return new \maliklibs\Zkteco\Lib\ZKTeco(
                Config::get('zkteco.default_ip', '192.168.1.201'),
                Config::get('zkteco.default_port', 4370),
                Config::get('zkteco.timeout', 5)
            );
        });

        // Bind the concrete class for dependency injection
        $this->app->bind(\maliklibs\Zkteco\Lib\ZKTeco::class, function ($app) {
            return $app->make('zkteco');
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/zkteco.php' => config_path('zkteco.php'),
            ], 'zkteco-config');
        }

        // Register facade alias
        $this->app->alias('zkteco', \maliklibs\Zkteco\Facades\ZKTeco::class);
    }
}