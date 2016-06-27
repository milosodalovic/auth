<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ elixir("css/all.css") }}">
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body id="app-layout">

    <!-- Navigation -->
    @include('layouts.partials.nav')

    <!-- Contents -->
    @yield('content')

    <!-- JavaScripts -->
    <script src="{{ elixir("js/all.js") }}"></script>

    <!-- Additional JavaScripts -->
    @yield('scripts')

    <!-- FlashMessaging -->
    @include('alerts.flash')

</body>
</html>
