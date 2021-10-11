<?php
namespace App\Providers;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
    ];
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('manage-users', function($user){
            return $user->hasAnyRoles(['superadmin', 'admin']);
        });
        Gate::define('manage-signage', function($user){
            return $user->hasAnyRoles(['superadmin', 'admin', 'user']);
        });
        Gate::define('run-tests', function($user){
            return $user->hasAnyRoles(['superadmin', 'admin']);
        });
    }
}
