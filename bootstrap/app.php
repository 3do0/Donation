<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'livewire/upload-file',
            'livewire/*'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create()

    // ->withSchedule(function (Illuminate\Console\Scheduling\Schedule $schedule) {
    //     $schedule->command('entities:update-finished')->daily();
    //     $schedule->command('currency:update-rates')->everyMinute();
    // })
    ;
    
