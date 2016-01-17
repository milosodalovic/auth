@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Verify your email address to access the application</h3>
        We’ve just sent an email to your address: {{ $user->email }}. Please check your email and click on the link provided to verify your address.
    </div>
@stop