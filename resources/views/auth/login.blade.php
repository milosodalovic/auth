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

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}" data-parsley-validate>
                        {!! csrf_field() !!}

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
                                <button type="submit" class="btn btn-success btn-block">
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
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script type="text/javascript">
        var emailField = $('input[name=email]').parsley();
        var passwordField = $('input[name=password]').parsley();

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

        $('form').submit(function(){
            if(emailField.isValid() && passwordField.isValid()){
                $(this).find(':submit').attr('disabled','disabled');
            }
        });
    </script>
@stop