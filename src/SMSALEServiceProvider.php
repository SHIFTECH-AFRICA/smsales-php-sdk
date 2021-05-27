<?php

namespace SMSALES;

use Carbon\Laravel\ServiceProvider;

class SMSALEServiceProvider extends ServiceProvider
{
    /**
     * ----------------------------------------------------
     * define the boot method and the register method here
     * ----------------------------------------------------
     * @return void
     */
    public function boot()
    {
        /**
         * ---------------------------
         * load configuration file
         * ---------------------------
         */
        $this->mergeConfigFrom(
            __DIR__ . '/config/smsales.php', 'smsales'
        );

        /**
         * ---------------------------
         * publishing the config file
         * ---------------------------
         */
        $this->publishes([
            __DIR__ . '/config/smsales.php' => config_path('smsales.php'),
        ], 'config');
    }

    /**
     * ------------------------------
     * Register here for any service
     * like the facades here
     * ------------------------------
     * @return void
     */
    public function register()
    {
        //
    }
}
