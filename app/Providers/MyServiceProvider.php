<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Utils\OptionUtility;
use App\Utils\ResponseUtility;

class MyServiceProvider extends ServiceProvider
{
    public $bindings = [
        'responder' => ResponseUtility::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('option', static function () {
            return new OptionUtility();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
