<?php

namespace DuyDev\Providers;

use DuyDev\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->ideHelper();
    }

    public function ideHelper()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    public function setAppConfig()
    {
        if( \Schema::hasTable('configs') ) {
            foreach (Config::all() as $item){
                config([ "app.$item->key" => $item->value ]);
            }
        }
    }
}
