@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="row text-center margin-botoom-20">
                        <h3>Login to App</h3>
                    </div>

                    <!-- Social Authentication -->
                    @if(count(config('auth.social_providers')))
                        <div class="row">
                            @foreach(config('auth.social_providers') as $provider)
                                <div class="col-md-10 col-md-offset-1 margin-top-10">
                                    <a class="btn btn-block btn-{{ $provider }}" href="/auth/{{ $provider }}">
                                        <i class="fa fa-lg fa-btn fa-{{ $provider }}" aria-hidden="true"></i> | Login with {{ $provider }}
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <span class="or"><span class="or-text">or</span></span>

                        <div class="row text-center m-b-md">
                            <h5>Login with Email and Password</h5>
                        </div>
                    @endif

                    <login inline-template>
                        <validator name="validator">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}" @submit.prevent="onSubmit" novalidate>
                                {!! csrf_field() !!}

                                <!-- Email Address -->
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" :class="{ 'has-error':$validator.email.required && ! formValid }">
                                    <div class="col-md-10 col-md-offset-1">
                                        <input type="email" placeholder="E-Mail Address" class="form-control" name="email" value="{{ old('email') }}" v-validate:email="['required']">
                                        @include('errors.field', ['fieldName' => 'email'])
                                        <strong class="help-block" v-show="$validator.email.required && ! formValid">The email field is required!</strong>
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" :class="{ 'has-error': $validator.password.required && ! formValid }">
                                    <div class="col-md-10 col-md-offset-1">
                                        <input type="password" placeholder="Password" class="form-control" name="password" v-validate:password="['required']">
                                        @include('errors.field', ['fieldName' => 'password'])
                                        <strong class="help-block" v-show="$validator.password.required && ! formValid">The password field is required!</strong>
                                    </div>
                                </div>

                                <!-- Remember Me -->
                                <div class="form-group">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember"> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-10 col-md-offset-1">
                                        <button type="submit" class="btn btn-success btn-block" :disabled="formBusy">
                                            <i class="fa fa-btn fa-sign-in"></i> Login
                                        </button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-10 col-md-offset-1">
                                        <a href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                                        <a class="pull-right" href="/register">New User?</a>
                                    </div>
                                </div>

                            </form>
                        </validator>
                    </login>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection