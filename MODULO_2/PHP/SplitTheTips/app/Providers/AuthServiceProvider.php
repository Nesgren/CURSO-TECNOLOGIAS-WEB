<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
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

        // Definir permisos globales para el rol de empresa
        Gate::before(function (User $user, $ability) {
            if ($user->role === 'company') {
                return true; // La empresa tiene todos los permisos
            }
        });

        // Definir permisos específicos para empleados
        Gate::define('access-employee-features', function ($user) {
            return $user->role === 'employee' && $user->employee !== null;
        });

        // Definir un gate específico para acceso a áreas (por si acaso)
        Gate::define('access-areas', function ($user) {
            return $user->company !== null;
        });

        Gate::define('access-company-features', function ($user) {
            return $user->company !== null;
        });

        Gate::define('is-company', function ($user) {
            return $user->company !== null;
        });
        
        Gate::define('is-employee', function ($user) {
            return $user->employee !== null;
        });

        Gate::define('view-my-tips', function ($user) {
            return $user->role === 'employee' && $user->employee !== null;
        });
    }
}