var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    mix.sass('app.scss');
});
elixir(function(mix) {
    mix.styles([
        "bootstrap.min.css",
        "oneui.min.css"
    ], 'public/css/all.css');
});
elixir(function(mix) {
    mix.scripts([
        "oneui.min.js",
        "plugins/bootstrap-notify/bootstrap-notify.min.js",
        "plugins/jquery-validation/jquery.validate.min.js"

    ]);
});
