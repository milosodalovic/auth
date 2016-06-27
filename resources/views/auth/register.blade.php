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

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" data-parsley-validate>
                        {!! csrf_field() !!}

                        <!-- Name -->
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <input type="text" placeholder="Name" class="form-control" name="name" value="{{ old('name') }}" data-parsley-required data-parsley-maxlength="255">
                                @include('errors.field', ['fieldName' => 'name'])
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <input type="email" placeholder="E-Mail Address" class="form-control" name="email" value="{{ old('email') }}" data-parsley-required data-parsley-maxlength="255" data-parsley-type="email">
                                @include('errors.field', ['fieldName' => 'email'])
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <input type="password" placeholder="Password" class="form-control" name="password" data-parsley-required data-parsley-maxlength="255">
                                @include('errors.field', ['fieldName' => 'password'])
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <input type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" data-parsley-required data-parsley-maxlength="255" data-parsley-equalto="input[name=password]">
                                @include('errors.field', ['fieldName' => 'password_confirmation'])
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
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var nameField = $('input[name=name]').parsley();
        var emailField = $('input[name=email]').parsley();
        var passwordField = $('input[name=password]').parsley();
        var passwordConfirmationField = $('input[name=password_confirmation]').parsley();

        $('input[name=name]').on('blur', function() {
            if( ! nameField.isValid()){
                nameField.validate();
            }
        });

        $('input[name=email]').on('blur', function() {
            if( ! emailField.isValid()){
                emailField.validate();
            }
        });

        $('input[name=password]').on('blur', function() {
            if( ! passwordField.isValid()){
                passwordField.validate();
            }
        });

        $('input[name=password_confirmation]').on('blur', function() {
            if( ! passwordConfirmationField.isValid()){
                passwordConfirmationField.validate();
            }
        });

        $('form').submit(function(){
            if(nameField.isValid() && emailField.isValid()
                    && passwordField.isValid() && passwordConfirmationField.isValid()) {

                $(this).find(':submit').attr('disabled','disabled');
            }
        });
    </script>
@stop
