<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Mappages de stratégie pour l'application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Enregistrez tous les services d'authentification / autorisation.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
