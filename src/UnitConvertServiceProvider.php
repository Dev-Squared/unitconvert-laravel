<?php namespace DevSquared\UnitConvert;

use Illuminate\Support\ServiceProvider;

class UnitConvertServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $configFile = __DIR__ . '/../config/unitconvert.php';
        $this->publishes([
            $configFile => config_path('unitconvert.php'),
        ]);

        $this->mergeConfigFrom($configFile, 'unitconvert');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UnitConvert::class, function () {
            return new UnitConvert();
        });
        $this->app->alias(UnitConvert::class, 'unitconvert-laravel');
    }
}