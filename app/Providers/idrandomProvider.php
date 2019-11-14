<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class idrandomProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require app_path().'/Helper/idrandom.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
