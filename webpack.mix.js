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

mix.react('resources/assets/frontend/js/app.js', 'public/frontend/js/custom.js')
    .sass('resources/assets/frontend/sass/app.scss', 'public/frontend/css/custom.css');

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
    'resources/assets/frontend/js/moment.js',
    'resources/assets/frontend/js/bootstrap-datetimepicker.js',
], 'public/frontend/js/app.js')
.combine([
    'resources/assets/frontend/css/bootstrap.min.css',
    'resources/assets/frontend/css/fonts.googleapis.css',
    'resources/assets/frontend/css/font-awesome.min.css',
    'resources/assets/frontend/css/icon-font.min.css',
    'resources/assets/frontend/css/cs.styles.css',
    'resources/assets/frontend/css/font-icon.css',
    'resources/assets/frontend/css/spr.css',
    'resources/assets/frontend/css/slideshow-fade.css',
    'resources/assets/frontend/css/cs.animate.css',
    'resources/assets/frontend/css/themepunch.revolution.css',
    'resources/assets/frontend/css/jquery.fancybox.css',
    'resources/assets/frontend/css/bootstrap-datetimepicker.min.css',
], 'public/frontend/css/app.css');