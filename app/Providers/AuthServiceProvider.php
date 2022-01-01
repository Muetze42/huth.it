<?php

namespace App\Providers;

use App\Models\CustomerApiClient;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
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

        Auth::viaRequest('customer-api', function (Request $request) {
            return $this->customerApiAuth($request);
        });
    }

    /**
     * @param Request $request
     * @return CustomerApiClient
     */
    protected function customerApiAuth(Request $request): CustomerApiClient
    {
        App::setLocale('en');

        $clientId = $request->header('ClientId');
        $token = $request->bearerToken();

        if (!$clientId) {
            abort(jsonResponse('The ClientId must be specified in the header', 401));
        }

        if (!$token) {
            abort(jsonResponse('Missing Bearer token', 401));
        }

        $client = CustomerApiClient::where('client_id', $clientId)->first();

        if (!$client) {
            abort(jsonResponse('Client not exists', 401));
        }

        if ($client->token != $token) {
            abort(jsonResponse('Invalid Token', 401));
        }

        if (!$request->routeIs('api.customer.refresh-token') && $client->expired_at && $client->expired_at <= now()) {
            abort(jsonResponse('The token has expired', 401));
        }

        $client->timestamps = false;
        $client->update(['used_at' => now()]);
        $client->timestamps = true;

        return $client;
    }
}
