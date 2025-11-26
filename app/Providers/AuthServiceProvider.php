<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    
    protected $policies = [
        \App\Models\Pet::class => \App\Policies\PetPolicy::class,
    ];
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
