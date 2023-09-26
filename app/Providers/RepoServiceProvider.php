<?php

namespace App\Providers;

use App\Repositories\AuthInterface;
use App\Repositories\AuthRepositrie;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
AuthInterface::class,AuthRepositrie::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
