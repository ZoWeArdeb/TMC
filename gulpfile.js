const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix
        .sass([
            'app.scss',
            'vendor/bootstrap-datetimepicker-build.scss'
        ], 'public/css/app.css')
        .webpack([
            'app.js',
            'vendor/bootstrap-datetimepicker.js',
            'tournament.js'
        ], 'public/js/app.js')
        .copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/','public/fonts/bootstrap');
});
