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
        // Register your model policies here if needed
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define admin gate
        Gate::define('admin', function ($user) {
            return $user->isAdmin();
        });

        // Define security gate (admins inherit security permissions)
        Gate::define('security', function ($user) {
            return $user->isSecurity() || $user->isAdmin();
        });

        // Define resident gate
        Gate::define('resident', function ($user) {
            return $user->isResident();
        });

        // Optional: Define a super-admin gate if needed
        Gate::define('super-admin', function ($user) {
            return $user->isSuperAdmin(); // You would need to implement this method
        });

        // Additional role-based gates can be added here
    }
}
