<?php

namespace App\Providers;

use App\Models\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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

        Auth::viaRequest('consumer-api', function (Request $request) {
            return $this->consumerApiAuth($request);
        });
    }

    /**
     * @param Request $request
     * @return Model|Builder|Client
     */
    protected function consumerApiAuth(Request $request): Model|Builder|Client
    {
        App::setLocale('en');

        $clientId = $request->header('ClientId');

        if (!$clientId) {
            abort(jsonResponse('The ClientId must be specified in the header', 401));
        }

        $client = Client::where('client_id', $clientId)->firstOrFail();
        $token = $request->bearerToken();

        if (!$token) {
            abort(jsonResponse('Missing Bearer Token', 401));
        }

        if ($client->token != $token) {
            abort(jsonResponse('Invalid Bearer Token', 401));
        }

        if (!$request->routeIs('api.consumer.client.refresh-token') && $client->expired_at && $client->expired_at <= now()) {
            abort(jsonResponse('The token has expired', 401));
        }

        $client->timestamps = false;
        $client->update(['used_at' => now()]);
        $client->timestamps = true;

        return $client;
    }
}
