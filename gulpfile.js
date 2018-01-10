const elixir = require('laravel-elixir');

elixir((mix) => {
  mix.sass('about-style.scss')
    .sass('activities-style.scss')
    .sass('activity-style.scss')
    .sass('agency-style.scss')
    .sass('calendar-style.scss')
    .sass('common.scss')
    .sass('free-style.scss')
    .sass('guide-style.scss')
    .sass('home.scss')
    .sass('print-style.scss')
    .sass('activity-print.scss')
    .sass('reservation-style.scss')
    .sass('send-offer-style.scss')
    .sass('user-account-style.scss')
    .sass('user-reservations-style.scss')
    .sass('coupon-print.scss')
    .sass('routes.scss')
    .webpack('activities-scripts.js')
    .webpack('activity-scripts.js')
    .webpack('agency-scripts.js')
    .webpack('calendarpage-scripts.js')
    .webpack('common.js')
    .webpack('fixed-sidebar.js')
    .webpack('free-pages-scripts.js')
    .webpack('guide-scripts.js')
    .webpack('home.js')
    .webpack('instafeed-settings.js')
    .webpack('product.tour.js')
    .webpack('send-offer-scripts.js')
    .webpack('user-account-scripts.js')
    .webpack('user-reservations-scripts.js')
    .webpack('reservation-scripts.js')
    .webpack('routes.js')
    .version([
      'css/about-style.css',
      'css/activities-style.css',
      'css/activity-style.css',
      'css/agency-style.css',
      'css/calendar-style.css',
      'css/common.css',
      'css/free-style.css',
      'css/guide-style.css',
      'css/home.css',
      'css/reservation-style.css',
      'css/send-offer-style.css',
      'css/user-account-style.css',
      'css/user-reservations-style.css',
      'css/routes.css',
      'js/activities-scripts.js',
      'js/activity-scripts.js',
      'js/agency-scripts.js',
      'js/calendarpage-scripts.js',
      'js/common.js',
      'js/fixed-sidebar.js',
      'js/free-pages-scripts.js',
      'js/guide-scripts.js',
      'js/home.js',
      'js/instafeed-settings.js',
      'js/product.tour.js',
      'js/send-offer-scripts.js',
      'js/user-account-scripts.js',
      'js/user-reservations-scripts.js',
      'js/reservation-scripts.js',
      'js/routes.js'
    ])
});


// elixir((mix) => {
//   mix.sass('home.scss')
//     .webpack('routes.js')
//     .version([
//       'css/home.css',
//       'js/routes.js'
//     ])
// });