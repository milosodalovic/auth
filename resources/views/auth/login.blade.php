@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="row text-center">
                            <h3>Login to App</h3>
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
                                <h5>Login with Email and Password</h5>
                            </div>
                        @endif

                        <login inline-template>
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}" @submit.prevent="onSubmit" v-cloak data-parsley-validate>
                                {!! csrf_field() !!}

                                <!-- Email Address -->
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <input type="email" placeholder="E-Mail Address" class="form-control" name="email" value="{{ old('email') }}" data-parsley-required data-parsley-type="email">
                                        @include('errors.field', ['fieldName' => 'email'])
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <input type="password" placeholder="Password" class="form-control" name="password" data-parsley-required>
                                        @include('errors.field', ['fieldName' => 'password'])
                                    </div>
                                </div>

                                <!-- Remember Me -->
                                <div class="form-group">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <label class="custom-checkbox">
                                            <input type="checkbox" name="remember"><i></i>Remember me
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <button type="submit" class="btn btn-success btn-block" :disabled="formBusy">
                                            <i class="fa fa-btn fa-sign-in"></i>Login
                                        </button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <a href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                                        <a class="pull-right" href="/register">New User?</a>
                                    </div>
                                </div>

                            </form>
                        </login>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection