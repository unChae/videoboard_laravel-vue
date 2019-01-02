<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Make sure to put this at the top of your AppServiceProvider: use Illuminate\Support\Facades\Validator;

        Validator::extend('youtube', function ($attribute, $value, $parameters, $validator) {
            return preg_match("/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/", $value);
        }, "Sorry, this doesn't look like a valid youtube URL");
    }
}
