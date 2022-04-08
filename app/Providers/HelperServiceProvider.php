<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $rdi = new RecursiveDirectoryIterator(app_path('Helpers'));
        $ri2 = new RecursiveIteratorIterator($rdi);

        while ($ri2->valid()) {
            if (
                ! $ri2->isDot() &&
                $ri2->isFile() &&
                $ri2->isReadable() &&
                $ri2->current()->getExtension() === 'php' &&
                strpos($ri2->current()->getFilename(), 'Helper')
            ) {
                require $ri2->key();
            }

            $ri2->next();
        }
    }
}
