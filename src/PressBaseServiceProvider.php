<?php

namespace Vicgonvt\Press;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Vicgonvt\Press\Console\ProcessCommand;
use Vicgonvt\Press\Facades\Press;

class PressBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }
        $this->registerResources();
    }

    public function register()
    {
        $this->commands([
            ProcessCommand::class,
        ]);
    }

    private function registerResources()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'press');
        $this->registerFacades();
        $this->registerRoute();
    }

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../config/press.php' => config_path('press.php'),
        ], 'press-config');
    }

    protected function registerRoute()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    private function routeConfiguration(): array
    {
        return [
            'prefix' => Press::path(),
            'namespace' => 'Vicgonvt\Press\Http\Controllers'
        ];
    }

    protected function registerFacades()
    {
        $this->app->singleton('Press', function($app) {
            return new \Vicgonvt\Press\Press();
        });
    }
}