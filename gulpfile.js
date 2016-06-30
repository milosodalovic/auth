var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

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
            'resources/assets/css/lib/sweetalert.css',
            'resources/assets/css/app.css',
        ],'public/css/all.css','./')

        .browserify('main.js','resources/assets/js/browserify-main.js')

        .scripts([
            'resources/assets/js/browserify-main.js',
            'resources/assets/js/lib/jquery.min.js',
            'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
            'resources/assets/js/lib/sweetalert-dev.js',
            'resources/assets/js/app.js',
        ],'public/js/all.js','./')

        .version(['css/all.css', 'js/all.js'])

        .copy('node_modules/font-awesome/fonts', 'public/build/fonts');

});
