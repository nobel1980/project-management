<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
/*
        Gate::define('access-admin', function ($user) {
            return $user->isAdmin();
        });
    
        Gate::define('access-developer', function ($user) {
            return $user->isDeveloper() || $user->isAdmin();
        });

        Gate::define('access-user', function ($user) {
            return $user->isUser() || $user->isAdmin();
        });
    */ 
        Gate::define('access-admin', function ($user) {
            \Log::info("Checking access-admin for user: {$user->id}");
            return $user->hasRole('Administrator');
        });

        Gate::define('access-developer', function ($user) {
            return $user->hasRole('Developer');
        });

        Gate::define('access-user', function ($user) {
            return $user->hasRole('User');
        });

        // Gate::define('view-projects', function ($user) {
        //     return $user->hasAnyRole(['Administrator', 'Developer', 'User']);
        // });   
    }
}
