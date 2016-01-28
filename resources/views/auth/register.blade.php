@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" data-parsley-validate>
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" data-parsley-required data-parsley-maxlength="255" data-parsley-type="alphanum">

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" data-parsley-required data-parsley-maxlength="255" data-parsley-type="alphanum">

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" data-parsley-required data-parsley-maxlength="255" data-parsley-type="email">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" data-parsley-required data-parsley-maxlength="255">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation" data-parsley-required data-parsley-maxlength="255" data-parsley-equalto="input[name=password]">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Register
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
        var first_name = $('input[name=first_name]').parsley();
        var last_name = $('input[name=last_name]').parsley();
        var email = $('input[name=email]').parsley();
        var password = $('input[name=password]').parsley();
        var password_confirmation = $('input[name=password_confirmation]').parsley();

        $('input[name=first_name]').on('blur', function() {
            if( ! first_name.isValid()){
                first_name.validate();
            }
        });

        $('input[name=last_name]').on('blur', function() {
            if( ! last_name.isValid()){
                last_name.validate();
            }
        });

        $('input[name=email]').on('blur', function() {
            if( ! email.isValid()){
                email.validate();
            }
        });

        $('input[name=password]').on('blur', function() {
            if( ! password.isValid()){
                password.validate();
            }
        });

        $('input[name=password_confirmation]').on('blur', function() {
            if( ! password_confirmation.isValid()){
                password_confirmation.validate();
            }
        });

        $('form').submit(function(){
            if(first_name.isValid() && last_name.isValid() && email.isValid()
                    && password.isValid() && password_confirmation.isValid()) {

                $(this).find(':submit').attr('disabled','disabled');
            }
        });
    </script>
@stop
