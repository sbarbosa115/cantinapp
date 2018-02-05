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

mix.react('resources/assets/restaurant/js/app.js', 'public/restaurant/js')
    .sass('resources/assets/restaurant/sass/app.scss', 'public/restaurant/css');

mix.combine([
    'resources/assets/frontend/js/jquery.min.js',
    'resources/assets/frontend/js/classie.js',
    'resources/assets/frontend/js/application-appear.js',
    'resources/assets/frontend/js/jquery.themepunch.plugins.min.js',
    'resources/assets/frontend/js/jquery.themepunch.revolution.min.js',
    'resources/assets/frontend/js/cs.script.js',
    'resources/assets/frontend/js/jquery.currencies.min.js',
    'resources/assets/frontend/js/jquery.zoom.min.js',
    'resources/assets/frontend/js/linkOptionSelectors.js',
    'resources/assets/frontend/js/owl.carousel.min.js',
    'resources/assets/frontend/js/scripts.js',
    'resources/assets/frontend/js/social-buttons.js',
    'resources/assets/frontend/js/bootstrap.min.js',
    'resources/assets/frontend/js/jquery.touchSwipe.min.js',
    'resources/assets/frontend/js/jquery.fancybox.js',
], 'public/frontend/js/app.js')
.combine(['resources/assets/frontend/css/*.css'], 'public/frontend/css/app.css');