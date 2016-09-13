<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\ConfirmAccount;
use App\User;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait RegistersUsers
{
    use RedirectsUsers, ChecksCaptcha;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        //check captcha
        if(config('auth.options.captcha')) {
            if( ! $this->checkCaptcha()) {
                return redirect()->back()->withErrors(['g-recaptcha-response' => 'Wrong Captcha'])->withInput();
            }
        }

        $user = $this->create($request->all());

        if(config('auth.options.confirm_email')){
            $user->token = str_random(30);
            $user->save();

            $user->notify(new ConfirmAccount($user));
            return view('auth.confirm', compact('user'));
        }

        $user->confirmed = true;
        $user->save();
        $this->guard()->login($user);

        return redirect($this->redirectPath());
    }

    /**
     * Handle a confirm registration request.
     * Find the user to be confirmed and update it.
     *
     * @param $token
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmRegistration($token, Request $request)
    {
        $unconfirmedUsers = User::notConfirmed()->get();

        foreach($unconfirmedUsers as $user) {
            if($user->token == $token) {
                $user->confirmed = true;
                $user->token = null;
                $user->save();
                $this->guard()->login($user);

                return redirect($this->redirectPath());
            }
        }

        return redirect('/');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
