<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Traits\GoogleCalendar;
use Google\Exception as GoogleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use GoogleCalendar;

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

    /**
     * @throws GoogleException
     * @return RedirectResponse
     */
    public function googleRedirect(): RedirectResponse
    {
        $this->googleCalendarInit();

        $authUrl = $this->googleClient->createAuthUrl();

        return redirect($authUrl);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws GoogleException
     */
    public function googleCallback(Request $request): RedirectResponse
    {
        $code = $request->input('code');
        $this->googleCalendarInit();

        $token = $this->googleClient->fetchAccessTokenWithAuthCode($code);

        Auth::user()->update([
            'google_token' => $token['access_token'],
        ]);

        return redirect()->route('home');
    }
}
