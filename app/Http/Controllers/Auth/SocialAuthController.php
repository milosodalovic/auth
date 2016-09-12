<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Laravel\Socialite\Facades\Socialite;
use Validator;
use App\Http\Controllers\Controller;

class SocialAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SocialAuth Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the social authentication and registration
    |
    */

    use RedirectsUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * SocialAuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Redirect the user to the provider authentication page.
     *
     * @param $provider
     * @return mixed
     */
    public function redirectToProvider($provider)
    {
        if( ! in_array($provider, config('auth.social_providers'))) {
            abort(403);
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the provider.
     *
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleProviderCallback($provider)
    {
        if( ! in_array($provider, config('auth.social_providers'))) {
            abort(403);
        }

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch(\Exception $e) {
            return redirect('/');
        }

        $user = $this->findOrCreateSocialUser($socialUser, $provider);
        auth()->login($user);

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Find or Create a new user
     *
     * @param $socialUser
     * @param $provider
     * @return mixed
     */
    protected function findOrCreateSocialUser($socialUser, $provider)
    {
        $userData = [
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'provider' => $provider,
            'provider_id' => $socialUser->id,
            'photo_url' => $socialUser->avatar,
            'confirmed' => true,
        ];

        //check if user already registered via provider
        $user = User::firstOrNew(['provider_id' => $userData['provider_id']]);

        if($user->exists) return $user;

        //if not check if there's already a user with this email address
        $user = User::firstOrNew(['email' => $userData['email']]);

        if($user->exists) {
            $user->forceFill($userData)->save();
            return $user;
        }

        //create a new user
        $user->forceFill($userData)->save();

        return $user;
    }
}
