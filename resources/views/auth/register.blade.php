@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="row text-center">
                            <h3>Register for App</h3>
                        </div>

                        <!-- Social Authentication -->
                        @if(count(config('auth.social_providers')))
                            <div class="row text-center margin-top-10">
                                @foreach(config('auth.social_providers') as $provider)
                                    <a class="btn btn-social-icon btn-{{ $provider }}" href="/auth/{{ $provider }}">
                                        <i class="fa fa-lg fa-btn fa-{{ $provider }}" aria-hidden="true"></i>
                                    </a>
                                @endforeach
                            </div>

                            <span class="or"><span class="or-text">or</span></span>

                            <div class="row text-center margin-bottom-10">
                                <h5>Register with Email and Password</h5>
                            </div>
                        @endif

                        <register inline-template>
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" @submit.prevent="onSubmit" v-cloak data-parsley-validate>
                                {!! csrf_field() !!}

                                <!-- Name -->
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <input type="text" placeholder="Name" class="form-control" name="name" value="{{ old('name') }}" data-parsley-required data-parsley-maxlength="255" data-parsley-minlength="2">
                                        @include('errors.field', ['fieldName' => 'name'])
                                    </div>
                                </div>

                                <!-- Email Address -->
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <input type="email" placeholder="E-Mail Address" class="form-control" name="email" value="{{ old('email') }}" data-parsley-required data-parsley-maxlength="255" data-parsley-type="email">
                                        @include('errors.field', ['fieldName' => 'email'])
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <input type="password" placeholder="Password" class="form-control" name="password" data-parsley-required data-parsley-maxlength="255">
                                        @include('errors.field', ['fieldName' => 'password'])
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <input type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" data-parsley-required data-parsley-maxlength="255" data-parsley-equalto="input[name=password]">
                                        @include('errors.field', ['fieldName' => 'password_confirmation'])
                                    </div>
                                </div>

                                @if(config('auth.options.captcha'))
                                    <!-- Google reCaptcha -->
                                    <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site') }}" style="transform:scale(0.89); transform-origin:0 0" ></div>
                                            @include('errors.field', ['fieldName' => 'g-recaptcha-response'])
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <button class="btn btn-block btn-success" :disabled="formBusy">
                                            <span v-if="formBusy"><i class="fa fa-btn fa-spinner fa-spin"></i>Registering</span>
                                            <span v-else><i class="fa fa-btn fa-check-circle"></i>Register</span>
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </register>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

