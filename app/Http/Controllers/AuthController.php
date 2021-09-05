<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @param $provider
     * @return SymfonyRedirectResponse
     */
    public function redirect($provider): SymfonyRedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @param Request $request
     * @param $provider
     * @return RedirectResponse
     */
    public function callback(Request $request, $provider): RedirectResponse
    {
        $socialiteUser = Socialite::driver($provider)->user();

        $user = User::where(['github_id' => $socialiteUser->getId()])->first();

        if (!$user) {
            abort(Response::HTTP_FORBIDDEN);
        }

        Auth::login($user, true);

        return redirect(config('nova.path'));
    }
}
