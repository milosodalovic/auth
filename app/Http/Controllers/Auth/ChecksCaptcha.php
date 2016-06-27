<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use ReCaptcha\ReCaptcha;

trait ChecksCaptcha {

    public function checkCaptcha()
    {

        $response = Input::get('g-recaptcha-response');
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $secret   = config('services.recaptcha.secret');
        $recaptcha = new ReCaptcha($secret);
        $resp = $recaptcha->verify($response, $remoteip);

        if ($resp->isSuccess()) {
            return true;
        } else {
            return false;
        }

    }

}
