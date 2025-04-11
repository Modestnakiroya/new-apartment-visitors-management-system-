<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [

    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('admin', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('security', function ($user) {
            return $user->isSecurity() || $user->isAdmin();
        });

        // Define resident gate
        Gate::define('resident', function ($user) {
            return $user->isResident();
        });

        Gate::define('super-admin', function ($user) {
            return $user->isSuperAdmin();
        });
    }
}
