const mix = require('laravel-mix')

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

// App
mix
    .js('resources/admin/js/app.js', 'public/admin/js')
    .sass('resources/admin/sass/app.scss', 'public/admin/css')
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')

if (mix.inProduction()) {
    mix.version()
}