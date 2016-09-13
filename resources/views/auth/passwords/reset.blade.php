@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="panel panel-default">

                <div class="panel-body">

                    <div class="row text-center margin-bottom-20">
                        <h3>Reset Password</h3>
                    </div>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}" data-parsley-validate>
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-sm-10 col-sm-offset-1">
                                <input type="email" placeholder="E-Mail Address" class="form-control" name="email" value="{{ old('email') }}" data-parsley-required data-parsley-type="email">
                                @include('errors.field', ['fieldName' => 'email'])
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-sm-10 col-sm-offset-1">
                                <input type="password" placeholder="New Password" class="form-control" name="password" value="{{ old('password') }}" data-parsley-required data-parsley-maxlength="255">
                                @include('errors.field', ['fieldName' => 'password'])
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div class="col-sm-10 col-sm-offset-1">
                                <input type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" data-parsley-required data-parsley-maxlength="255" data-parsley-equalto="input[name=password]">
                                @include('errors.field', ['fieldName' => 'password_confirmation'])
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-1">
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fa fa-btn fa-refresh"></i>Reset Password
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
