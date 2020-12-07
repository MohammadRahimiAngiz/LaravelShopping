<?php

namespace App\Providers;

use App\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//         'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        //allows total for super user

        Gate::before( function ($user){
            if( $user->isSuperUser()){
                return true;
            }
        });
        $this->registerPolicies();
        foreach (Permission::all() as $permission) {
            Gate::define($permission->name, fn($user) => $user->hasPermission($permission));
        }
    }
}
