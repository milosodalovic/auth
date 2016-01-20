var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing other resources.
 |
 */

elixir(function(mix) {
    mix.sass([
        'app.scss'
    ], 'resources/assets/css/app.css')

        .styles([
            'lib/bootstrap.min.css',
            'lib/font-awesome.min.css',
            'lib/parsley.css',
            'lib/sweetalert.css',
            'app.css',
        ],'public/css/all.css')

        .scripts([
            'lib/jquery.min.js',
            'lib/bootstrap.min.js',
            'lib/parsley.min.js',
            'lib/sweetalert-dev.js',
            'pubsub.js',
            'ajax-helpers.js',
            'app.js',
        ],'public/js/all.js')

        .version(['css/all.css', 'js/all.js'])

        .copy('resources/assets/other/font-awesome/fonts', 'public/build/fonts');
});
