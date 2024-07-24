<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Filament;
use App\Filament\Admin\Resources\UserResource;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
     public function boot()
     {
         Filament::registerResource(UserResource::class);
 
         Filament::defaultPanel('dashboard');
     }
}
