<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ExtensionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach (glob(app_path() . '/Plugins/Extensions/*/*/Provider.php') as $filename) {
            require_once $filename;
        }
        foreach (glob(app_path() . '/Plugins/Modules/*/*/Provider.php') as $filename) {
            require_once $filename;
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
