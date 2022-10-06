<?php

namespace Kevinpurwito\LaravelMailcoachApi;

use Illuminate\Support\ServiceProvider;

class MailcoachApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->offerPublishing();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/kp_mailcoach.php', 'kp_mailcoach');

        $this->app->singleton('MailcoachApi', function () {
            return new MailcoachApi(
                config('kp_mailcoach.url', env('KP_MAILCOACH_API_URL', '')),
                config('kp_mailcoach.token', env('KP_MAILCOACH_API_TOKEN', '')),
            );
        });
    }

    protected function offerPublishing()
    {
        if (! function_exists('config_path')) {
            // function not available and 'publish' not relevant in Lumen
            return;
        }

        // config
        $this->publishes([
            __DIR__ . '/../config/kp_mailcoach.php' => config_path('kp_mailcoach.php'),
        ], ['kp_mailcoach']);
    }
}
