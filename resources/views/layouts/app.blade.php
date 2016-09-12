<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ elixir("css/all.css") }}">

    <!-- Additional Styles -->
    @yield('styles')

    @if(config('auth.options.captcha'))
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endif

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>

<body id="app">

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
