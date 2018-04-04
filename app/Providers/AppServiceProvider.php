<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\AuditTrail\Activity\RepositoryInterface as ActivityRepository;
use App\Setting;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Event::subscribe('App\AuditTrail\EventHandler');
        $site_settings = Setting::pluck('value', 'key');
        View::share('site_settings', $site_settings);
        //Schema::defaultStringLength(191);
        
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Moderator\RepositoryInterface', 'App\Moderator\EloquentRepository');
        //$this->app->bind('App\Agenda\RepositoryInterface', 'App\Agenda\EloquentRepository');
        $this->app->bind('App\Post\RepositoryInterface', 'App\Post\EloquentRepository');
        $this->app->bind('App\Officer\RepositoryInterface', 'App\Officer\EloquentRepository');
        $this->app->bind('App\Lookup\RepositoryInterface', 'App\Lookup\EloquentRepository');
        $this->app->bind('App\Menu\RepositoryInterface', 'App\Menu\EloquentRepository');
        $this->app->bind('App\AuditTrail\Activity\RepositoryInterface', 'App\AuditTrail\Activity\EloquentRepository');
        //$this->app->bind('App\Gallery\RepositoryInterface', 'App\Gallery\EloquentRepository');
        $this->app->bind('App\Transaksi\RepositoryInterface', 'App\Transaksi\EloquentRepository');
        $this->app->bind('App\Mobil\RepositoryInterface', 'App\Mobil\EloquentRepository');
        //$this->app->bind('App\Map\RepositoryInterface', 'App\Map\EloquentRepository');

        /*$this->app->bind('path.public', function() {
          return realpath(__DIR__.'/../../..');
        });*/
    
    }
}
