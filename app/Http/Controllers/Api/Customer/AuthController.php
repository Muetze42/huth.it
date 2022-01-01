<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function requestToken(Request $request)
    {
        $refreshToken = $request->header('RefreshToken');

        if ($refreshToken != auth()->user()->refresh_token) {
            abort(jsonResponse('Wrong Refresh Token', 401));
        }

        $newToken = Str::random(32);

        $expiredAt = null;
        if (auth()->user()->token_lifetime) {
            $rand = config('customer-api.token-lifetimes.'.auth()->user()->token_lifetime);
            if (is_array($rand) && count($rand) == 2) {
                $minutes = mt_rand($rand[0], $rand[1]);
                $expiredAt = now()->addMinutes($minutes);
            }
        }

        auth()->user()->update([
            'token'      => $newToken,
            'expired_at' => $expiredAt,
        ]);

        abort(jsonResponse('New Token: '.$newToken, 201));
    }
}
