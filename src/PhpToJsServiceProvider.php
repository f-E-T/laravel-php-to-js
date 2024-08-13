<?php

namespace Fet\PhpToJs;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;

class PhpToJsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'phptojs');

        $this->publishes([
            __DIR__ . '/../config/phptojs.php' => config_path('phptojs.php'),
        ], 'config');

        $this->registerMiddleware(PhpToJsMiddleware::class);
    }

    public function register(): void
    {
        $this->app->singleton(PhpToJs::class, function ($app) {
            $phpToJs = new PhpToJs();

            if (is_string($namespace = config('phptojs.namespace'))) {
                $phpToJs->setNamespace($namespace);
            }

            return $phpToJs;
        });

        $this->app->singleton('phptojs', function ($app) {
            return $app->make(PhpToJs::class);
        });
    }

    protected function registerMiddleware(string $middleware): void
    {
        // @phpstan-ignore-next-line
        $kernel = $this->app[Kernel::class];
        $kernel->appendMiddlewareToGroup('web', $middleware);
    }
}
