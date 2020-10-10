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
    .copy('node_modules/bootstrap-daterangepicker/daterangepicker.css', 'public/dist/css/bootstrap-daterangepicker.css')
    .copy('node_modules/bootstrap-daterangepicker/daterangepicker.js', 'public/dist/js/bootstrap-daterangepicker.js')
    .copy('node_modules/bootstrap-timepicker/css/bootstrap-timepicker.css', 'public/dist/css/bootstrap-timepicker.min.css')
    .copy('node_modules/bootstrap-timepicker/js/bootstrap-timepicker.js', 'public/dist/js/bootstrap-timepicker.js')
    .copy('node_modules/dropzone/dist/min/dropzone.min.css', 'public/dist/css/dropzone.min.css')
    .copy('node_modules/dropzone/dist/min/dropzone.min.js', 'public/dist/js/dropzone.min.js')
    .copy('node_modules/chart.js/dist/Chart.min.css', 'public/dist/css/chart.min.css')
    .copy('node_modules/chart.js/dist/Chart.min.js', 'public/dist/js/chart.min.js')
