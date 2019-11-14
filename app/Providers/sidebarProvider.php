<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class sidebarProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      require_once app_path().'/Helpers/sidebar.php';
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
