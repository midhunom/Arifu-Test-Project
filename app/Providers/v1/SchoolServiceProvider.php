<?php

namespace App\Providers\v1;

use App\Services\v1\SchoolService;
use Illuminate\Support\ServiceProvider;

class SchoolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SchoolService::class, function ($app){
            return new SchoolService();
        });
    }
}
