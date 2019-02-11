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

mix.js('resources/js/auth.js', 'public/js')
mix.js('resources/js/app.js', 'public/js')
mix.js('resources/js/admin.js', 'public/js')
mix.js('resources/js/announcement.js', 'public/js')
mix.js('resources/js/notifications.js', 'public/js')
mix.js('resources/js/profiles.js', 'public/js')
mix.js('resources/js/users.js', 'public/js')
mix.js('resources/js/roles.js', 'public/js')
mix.js('resources/js/sponsors.js', 'public/js')
mix.js('resources/js/revisors.js', 'public/js')
// mix.less('resources/less/site/site.less', 'public/css');