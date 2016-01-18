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
    use RedirectsUsers;

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

        $user = $this->create($request->all());

        if($this->isUsingEmailConfirmation){
            $this->sendConfirmLinkEmail($user);
            return view('auth.confirm', compact('user'));
        }

        $user->confirmed = 1;
        $user->save();
        Auth::guard($this->getGuard())->login($user);

        return redirect($this->redirectPath());
    }

    /**
     * Handle a confirm registration request
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getConfirmRegistration(Request $request)
    {
        if($request->has('token'))
        {
            $this->confirmUser($request);
        }

        return redirect('/');
    }

    /**
     * Find the user to be confirmed and update it
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmUser(Request $request)
    {
        $unconfirmedUsers = User::notConfirmed()->get();
        $token = $request->get('token');

        foreach($unconfirmedUsers as $user){
            if(Hash::check($user->email, $token))
            {
                $user->confirmed = 1;
                $user->save();
                Auth::guard($this->getGuard())->login($user);

                return redirect($this->redirectPath());
            }
        }

        return redirect('/');
    }

    /**
     * Send confirmation link to the User
     *
     * @param $user
     */
    public function sendConfirmLinkEmail($user)
    {
        $confirmAccountLink = url('confirm-account') . '?token=' . Hash::make($user->email);

        Mail::queue(['text' => 'auth.emails.confirm'], compact('user','confirmAccountLink'), function($message) use ($user) {
            $message->to($user->email);
            $message->from(env('MAIL_FROM',null),env('MAIL_NAME',null));
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
