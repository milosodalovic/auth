<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / confirmed registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Specify whether Email confirmation is required after registration
     *
     * @var boolean
     */
    protected $isUsingEmailConfirmation = true;

    /**
     * Create a new authentication controller instance.
     *
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'g-recaptcha-response.required' => 'Captcha is required!',
        ];

        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'g-recaptcha-response' => 'required',
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
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
