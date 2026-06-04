<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\Mailer\Transport\Smtp\SmtpTransport;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Password::defaults(function () {
            $rule = Password::min(4)->max(50);

            return $rule;
        });

        Queue::after(function () {
            try {
                $transport = Mail::mailer()->getSymfonyTransport();

                if ($transport instanceof SmtpTransport) {
                    $transport->stop();
                }
            } catch (Throwable $e) {
                // Ignorar: si no hay transport SMTP activo, no hay nada que cerrar.
            }
        });
    }
}
