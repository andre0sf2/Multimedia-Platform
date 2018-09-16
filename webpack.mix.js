const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app/app.js', 'public/js')
   .sass('resources/sass/app/app.scss', 'public/css');

mix.js('resources/js/backoffice/app.js', 'public/backoffice/js')
   .sass('resources/sass/backoffice/app.scss', 'public/backoffice/css');