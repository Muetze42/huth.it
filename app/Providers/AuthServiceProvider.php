<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use NormanHuth\ConsumerApiAdministration\app\Guard\CustomerApiGuard;

class AuthServiceProvider extends ServiceProvider
{
    use CustomerApiGuard;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerCustomerApiGuard();
    }
}
