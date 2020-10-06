const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/js/app.js', 'public/js')
    .sass('resources/css/app.scss', 'public/css')
    .copy('node_modules/select2/dist/css/select2.min.css', 'public/dist/css/select2.min.css')
    .copy('node_modules/select2/dist/js/select2.min.js', 'public/dist/js/select2.min.js')
    .copy('node_modules/bootstrap-timepicker/css/bootstrap-timepicker.css', 'public/dist/css/bootstrap-timepicker.min.css')
    .copy('node_modules/bootstrap-timepicker/js/bootstrap-timepicker.js', 'public/dist/js/bootstrap-timepicker.js');
