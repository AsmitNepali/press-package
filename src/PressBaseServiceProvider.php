<?php

namespace Vicgonvt\Press;

use Illuminate\Support\ServiceProvider;
use Vicgonvt\Press\Console\ProcessCommand;

class PressBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {

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
    }
}