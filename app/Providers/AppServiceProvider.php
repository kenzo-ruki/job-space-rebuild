<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Hashing\HashManager;
use App\Services\TransitionalHasher;
use App\Models\Menu;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //    
        $this->app->resolving(HashManager::class, function ($hashManager) {
            $hashManager->extend('bcrypt', function ($app) {
                return new TransitionalHasher($app['config']['hashing.bcrypt']);
            });
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $menus = Menu::all();
        $settings = Setting::all()->keyBy('key');
        view()->share(compact('menus', 'settings'));
    }
}
