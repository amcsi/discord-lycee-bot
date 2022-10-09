<?php

namespace App\Providers;

use Discord\Discord;
use Discord\WebSockets\Intents;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Discord::class, fn() => new Discord([
            'token' => config('services.discord.authToken'),
        ]));
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
