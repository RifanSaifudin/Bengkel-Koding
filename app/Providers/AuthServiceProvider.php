<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Tambahkan Gate untuk masing-masing role
        Gate::define('admin-role', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('dokter-role', function (User $user) {
            return $user->role === 'dokter';
        });

        Gate::define('pasien-role', function (User $user) {
            return $user->role === 'pasien';
        });
    }
}