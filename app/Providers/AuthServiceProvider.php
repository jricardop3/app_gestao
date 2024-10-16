<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Account; // Importa o modelo Account
use App\Policies\AccountPolicy; // Importa a política AccountPolicy
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Account::class => AccountPolicy::class, // Registra a política para o modelo Account
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Exemplo de uma Gate simples para verificar se o usuário é admin
        Gate::define('admin-access', function (User $user) {
            return $user->role === 'admin'; // Verifica se o usuário tem a role 'admin'
        });
    
        // Gate para verificar se o usuário tem a role de 'user'
        Gate::define('user-access', function (User $user) {
            return $user->role === 'user';
        });
    }
}
