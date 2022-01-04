<?php

namespace App\Http\Controllers\Api\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function refreshToken(Request $request)
    {
        $refreshToken = $request->input('refreshToken');

        if (!$refreshToken) {
            abort(jsonResponse('Missing Refresh Token', 401));
        }

        if ($refreshToken != auth()->user()->refresh_token) {
            abort(jsonResponse('Invalid Refresh Token', 401));
        }

        $token = Str::random(32);
        $refreshToken = Str::random(50);
        auth()->user()->update([
            'token' => $token,
            'refresh_token' => $refreshToken,
        ]);

        return response()->json([
            'message'           => 'Tokens updated',
            'new-token'         => $token,
            'new-refresh-token' => $refreshToken,
            'expired-at'        => null,
            // Todo: Expired handling
            'time'              => now(),
        ]);
    }
}
