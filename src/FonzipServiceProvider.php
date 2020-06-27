<?php

namespace TanerInCode\Fonzip;


use Illuminate\Support\ServiceProvider;

class FonzipServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/translations', 'fonzip');
        $this->publishes([
            __DIR__ . '/config/fonzip.php' => config_path('fonzip.php'),
        ], 'fonzip.config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Fonzip', function (){
            return new Fonzip();
        });
    }
}
