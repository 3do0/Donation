<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
            // عند تسجيل الدخول
    Event::listen(Login::class, function ($event) {
        $event->user->is_online = true;
        $event->user->save();
    });

    // عند تسجيل الخروج
    Event::listen(Logout::class, function ($event) {
        $event->user->is_online = false;
        $event->user->save();
    });
    }
}
