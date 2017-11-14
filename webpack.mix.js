let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .copy('resources/assets/js/emmet.js', 'public/js')
    .extract(['vue', 'axios']);

if (mix.inProduction()) {
    mix.version()
       .disableNotifications()
} else {
    mix.browserSync('tailwind-fiddle.dev')
       .disableNotifications()
}
