<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Tools\NarcoScript;

class NarcoScriptServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('NarcoScript', function () {
            return new NarcoScript;
        });
    }
}
