<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];


    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-directors', function (User $user)
        {
            return $user->role->name === 'admin';
        });

        Gate::define('manage-guards', function (User $user)
        {
            return $user->role->name === 'admin';
        });

        Gate::define('manage-prisoners', function (User $user)
        {
            return $user->role->name === 'admin';
        });


        Gate::define('manage-wards', function (User $user)
         {
            return $user->role->name === 'director';
        });

        Gate::define('manage-jails', function (User $user)
        {
            return $user->role->name === 'director';
        });

        //assignment of prisoners to cell and guards to wards
        Gate::define('manage-assignment', function (User $user) {
            return $user->role->name === 'director';
        });

    }
}
