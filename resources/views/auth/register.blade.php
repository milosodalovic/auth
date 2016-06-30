@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="row text-center margin-botoom-20">
                            <h3>Register for App</h3>
                        </div>

                        <!-- Social Authentication -->
                        @if(count(config('auth.social_providers')))
                            <div class="row">
                                @foreach(config('auth.social_providers') as $provider)
                                    <div class="col-md-10 col-md-offset-1 margin-top-10">
                                        <a class="btn btn-block btn-{{ $provider }}" href="/auth/{{ $provider }}">
                                            <i class="fa fa-lg fa-btn fa-{{ $provider }}" aria-hidden="true"></i> | Register with {{ $provider }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <span class="or"><span class="or-text">or</span></span>

                            <div class="row text-center m-b-md">
                                <h5>Register with Email and Password</h5>
                            </div>
                        @endif

                        <register inline-template>
                            <validator name="validator">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" @submit.prevent="onSubmit" novalidate>
                                    {!! csrf_field() !!}

                                    <!-- Name -->
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" :class="{ 'has-error': $validator.name.required && ! formValid }">
                                        <div class="col-md-10 col-md-offset-1">
                                            <input type="text" placeholder="Name" class="form-control" name="name" value="{{ old('name') }}" v-validate:name="['required']">

                                            @include('errors.field', ['fieldName' => 'name'])
                                            <strong class="help-block" v-show="$validator.name.required && ! formValid">The name field is required!</strong>
                                        </div>
                                    </div>

                                    <!-- Email Address -->
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" :class="{ 'has-error': $validator.email.required && ! formValid }">
                                        <div class="col-md-10 col-md-offset-1">
                                            <input type="email" placeholder="E-Mail Address" class="form-control" name="email" value="{{ old('email') }}" v-validate:email="['required']">

                                            @include('errors.field', ['fieldName' => 'email'])
                                            <strong class="help-block" v-show="$validator.email.required && ! formValid">The email is required!</strong>
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

                                    <!-- Confirm Password -->
                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}" :class="{ 'has-error': $validator.password_confirmation.required && ! formValid }">
                                        <div class="col-md-10 col-md-offset-1">
                                            <input type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" v-validate:password_confirmation="['required']">

                                            @include('errors.field', ['fieldName' => 'password_confirmation'])
                                            <strong class="help-block" v-show="$validator.password_confirmation.required && ! formValid">The confirm password field is required!</strong>
                                        </div>
                                    </div>

                                    <!-- Google reCaptcha -->
                                    <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                        <div class="col-md-10 col-md-offset-1">
                                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site') }}" style="transform:scale(0.89); transform-origin:0 0" ></div>
                                            @include('errors.field', ['fieldName' => 'g-recaptcha-response'])
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-10 col-md-offset-1">
                                            <button class="btn btn-success btn-block" :disabled="formBusy">
                                                <span v-if="formBusy">
                                                    <i class="fa fa-spinner fa-spin"></i> Registering
                                                </span>

                                                <span v-else>
                                                    <i class="fa fa-check-circle"></i> Register
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </validator>
                        </register>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection