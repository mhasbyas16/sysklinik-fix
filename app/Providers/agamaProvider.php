<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class agamaProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require app_path().'/Helper/agama.php';
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
