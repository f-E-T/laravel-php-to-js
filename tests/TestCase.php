<?php

namespace Fet\PhpToJs\Tests;

use Fet\PhpToJs\PhpToJsServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            PhpToJsServiceProvider::class,
        ];
    }
}