<?php

namespace Vicgonvt\Press\Tests;



use Vicgonvt\Press\PressBaseServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            PressBaseServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testdb');
        $app['config']->set('database.connection.testdb', [
            'driver' => 'sqlite',
            'database' =>  ':memory:'
        ]);
    }
}
