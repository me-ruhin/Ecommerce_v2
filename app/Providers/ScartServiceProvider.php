<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ScartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootScart();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach (glob(app_path() . '/Library/Helpers/*.php') as $filename) {
            require_once $filename;
        }
        $this->registerRouteMiddleware();
    }

    public function bootScart()
    {

        try {
            if (sc_config('LOG_SLACK_WEBHOOK_URL')) {
                config(['logging.channels.slack.url' => sc_config('LOG_SLACK_WEBHOOK_URL')]);
            }
            config(['app.name' => sc_store('title')]);

            //Config for  email
            $smtpMode = sc_config('email_action_smtp_mode') ? 'smtp' : 'sendmail';
            config(['mail.driver' => $smtpMode]);
            if ($smtpMode == 'smtp') {
                $smtpHost = empty(sc_config('smtp_host')) ? env('MAIL_HOST', '') : sc_config('smtp_host');
                $smtpPort = empty(sc_config('smtp_port')) ? env('MAIL_PORT', '') : sc_config('smtp_port');
                $smtpSecurity = empty(sc_config('smtp_security')) ? env('MAIL_ENCRYPTION', '') : sc_config('smtp_security');
                $smtpUser = empty(sc_config('smtp_user')) ? env('MAIL_USERNAME', '') : sc_config('smtp_user');
                $smtpPassword = empty(sc_config('smtp_password')) ? env('MAIL_PASSWORD', '') : sc_config('smtp_password');
                config(['mail.host' => $smtpHost]);
                config(['mail.port' => $smtpPort]);
                config(['mail.encryption' => $smtpSecurity]);
                config(['mail.username' => $smtpUser]);
                config(['mail.password' => $smtpPassword]);
            }

            config(
                ['mail.from' =>
                    [
                        'address' => sc_store('email'),
                        'name' => sc_store('title'),
                    ],
                ]
            );
            //email

            // Time zone
            config(['app.timezone' => (sc_config('SITE_TIMEZONE') ?? config('app.timezone'))]);
            // End time zone

            //Debug mode
            config(['app.debug' => env('APP_DEBUG') ? true : ((sc_config('APP_DEBUG') === 'on') ? true : false)]);
            //End debug mode

            //Admin prefix
            config(['app.admin_prefix' => (sc_config('ADMIN_PREFIX') ?: env('ADMIN_PREFIX', 'sc_admin'))]);
            //End Admin prefix


        } catch (\Exception $e) {
            //
        }

    }

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'localization' => \App\Http\Middleware\Localization::class,
        'currency' => \App\Http\Middleware\Currency::class,
    ];

    /**
     * Register the route middleware.
     *
     * @return void
     */
    protected function registerRouteMiddleware()
    {
        // register route middleware.
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }
    }
}
