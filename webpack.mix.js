let mix = require('laravel-mix').mix;

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

mix.js('resources/assets/js/activities-scripts.js', 'public/js')
    .js('resources/assets/js/activity-scripts.js', 'public/js')
    .js('resources/assets/js/agency-scripts.js', 'public/js')
    .js('resources/assets/js/calendarpage-scripts.js', 'public/js')
    .js('resources/assets/js/custom.js', 'public/js')
    .js('resources/assets/js/fixed-sidebar.js', 'public/js')
    .js('resources/assets/js/free-pages-scripts.js', 'public/js')
    .js('resources/assets/js/guide-scripts.js', 'public/js')
    .js('resources/assets/js/home-scripts.js', 'public/js')
    .js('resources/assets/js/instafeed-settings.js', 'public/js')
    .js('resources/assets/js/product.tour.js', 'public/js')
    .js('resources/assets/js/send-offer-scripts.js', 'public/js')
    .js('resources/assets/js/user-account-scripts.js', 'public/js')
    .js('resources/assets/js/user-reservations-scripts.js', 'public/js')
    .sass('resources/assets/sass/about-style.scss', 'public/css')
    .sass('resources/assets/sass/activities-style.scss', 'public/css')
    .sass('resources/assets/sass/activity-style.scss', 'public/css')
    .sass('resources/assets/sass/agency-style.scss', 'public/css')
    .sass('resources/assets/sass/calendar-style.scss', 'public/css')
    .sass('resources/assets/sass/common.scss', 'public/css')
    .sass('resources/assets/sass/free-style.scss', 'public/css')
    .sass('resources/assets/sass/guide-style.scss', 'public/css')
    .sass('resources/assets/sass/home-style.scss', 'public/css')
    .sass('resources/assets/sass/print-style.scss', 'public/css')
    .sass('resources/assets/sass/reservation-style.scss', 'public/css')
    .sass('resources/assets/sass/send-offer-style.scss', 'public/css')
    .sass('resources/assets/sass/user-account-style.scss', 'public/css')
    .sass('resources/assets/sass/user-reservations-style.scss', 'public/css')
    .options({
        processCssUrls: false
    });
