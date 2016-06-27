<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

trait RegistersUsers
{
    use RedirectsUsers, ChecksCaptcha;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return $this->showRegistrationForm();
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }

        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        return $this->register($request);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        //check captcha
        if( ! $this->checkCaptcha()) {
            return redirect()->back()->withErrors(['g-recaptcha-response' => 'Wrong Captcha']);
        }

        $user = $this->create($request->all());

        if($this->isUsingEmailConfirmation){
            $user->token = str_random(30);
            $user->save();

            $this->sendConfirmationEmail($user);
            return view('auth.confirm', compact('user'));
        }

        $user->confirmed = true;
        $user->save();
        Auth::guard($this->getGuard())->login($user);

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

        foreach($unconfirmedUsers as $user){
            if($user->token == $token)
            {
                $user->confirmed = true;
                $user->token = null;
                $user->save();
                Auth::guard($this->getGuard())->login($user);

                return redirect($this->redirectPath());
            }
        }

        return redirect('/');
    }

    /**
     * Send email confirmation email to the User
     *
     * @param $user
     */
    public function sendConfirmationEmail($user)
    {
        Mail::queue(['html' => 'auth.emails.confirm'], compact('user'), function($message) use ($user) {
            $message->to($user->email);
            $message->from(config('mail.from.address'),config('mail.from.name'));
            $message->subject('Account Confirmation');
        });
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return string|null
     */
    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }
}
