<?php

namespace App\Providers;

use App\Order;
use App\Permission;
use App\Policies\OrderPolicy;
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
        Order::class => OrderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        //allows total for super user

        Gate::before(function ($user) {
            if ($user->isSuperUser()) {
                return true;
            }
        });
        $this->registerPolicies();
        foreach (Permission::all() as $permission) {
            Gate::define($permission->name, fn($user) => $user->hasPermission($permission));
        }
    }
}
