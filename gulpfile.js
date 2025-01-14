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
    mix.sass('app.scss', 'resources/assets/css');

    mix.styles([
        'libs/toastr.css',
        'libs/bootstrap.min.css',
        'libs/bootstrap-reset.css',
        'libs/font-awesome.css',
        'libs/default-theme.css',
        'libs/select2.min.css',
        'libs/fileinput.css',
        'libs/jquery.nestable.css',
        'style.css',
        'style-responsive.css',
        'app.css'
    ]);

    mix.scripts([
        'libs/jquery.min.js',
        'libs/bootstrap.min.js',
        'libs/jquery.nicescroll.js',
        'libs/jquery.countTo.js',
        'libs/toastr.js',
        'libs/jquery.mask.js',
        'libs/select2.min.js',
        'libs/fileinput.js',
        'libs/jquery.nestable.js',
        'libs/jquery.validate.min.js',
        'ajax.js',
        'validations.js',
        'app.js'
    ]);
});
