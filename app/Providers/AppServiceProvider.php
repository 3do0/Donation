<?php

namespace App\Providers;

use App\Services\CurrencyChanges;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CurrencyChanges::class, function ($app) {
            return new CurrencyChanges();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
            
    Event::listen(Login::class, function ($event) {
        $event->user->is_online = true;
        $event->user->save();
    });

    Event::listen(Logout::class, function ($event) {
        $event->user->is_online = false;
        $event->user->save();
    });
    }
}
