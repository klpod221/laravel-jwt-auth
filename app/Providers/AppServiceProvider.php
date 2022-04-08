<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Notifications\DatabaseNotification;
use App\Channels\DatabaseChannel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Notifications\Channels\DatabaseChannel as BaseDatabaseChannel;
use Illuminate\Notifications\DatabaseNotification as BaseDatabaseNotification;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(config('const.default_string_length'));

        // Custom database notification
        $this->app->instance(BaseDatabaseChannel::class, new DatabaseChannel());
        $this->app->instance(BaseDatabaseNotification::class, new DatabaseNotification());
    }
}
