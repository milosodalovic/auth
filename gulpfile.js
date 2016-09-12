const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {

    mix.sass([
        'app.scss'
    ], 'resources/assets/css/app.css')

    mix.styles([
        'resources/assets/css/app.css',
        'resources/assets/css/lib/sweetalert.css',
    ],'public/css/all.css','./')

    mix.webpack('app.js','resources/assets/js/webpack-app.js')

    mix.scripts([
        'resources/assets/js/webpack-app.js',
        'resources/assets/js/lib/sweetalert-dev.js',
        'resources/assets/js/custom.js',
    ],'public/js/all.js','./')

    mix.version(['css/all.css', 'js/all.js'])

    mix.copy('node_modules/font-awesome/fonts', 'public/build/fonts');
});
