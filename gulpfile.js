const elixir = require('laravel-elixir');

// elixir((mix) => {
//   mix.sass('about-style.scss')
//     .sass('activities-style.scss')
//     .sass('activity-style.scss')
//     .sass('agency-style.scss')
//     .sass('calendar-style.scss')
//     .sass('common.scss')
//     .sass('free-style.scss')
//     .sass('guide-style.scss')
//     .sass('home-style.scss')
//     .sass('print-style.scss')
//     .sass('reservation-style.scss')
//     .sass('send-offer-style.scss')
//     .sass('user-account-style.scss')
//     .sass('user-reservations-style.scss')
//     .sass('coupon-print.scss')
//     .webpack('activities-scripts.js')
//     .webpack('activity-scripts.js')
//     .webpack('agency-scripts.js')
//     .webpack('calendarpage-scripts.js')
//     .webpack('common.js')
//     .webpack('fixed-sidebar.js')
//     .webpack('free-pages-scripts.js')
//     .webpack('guide-scripts.js')
//     .webpack('home-scripts.js')
//     .webpack('instafeed-settings.js')
//     .webpack('product.tour.js')
//     .webpack('send-offer-scripts.js')
//     .webpack('user-account-scripts.js')
//     .webpack('user-reservations-scripts.js')
//     .webpack('reservation-scripts.js')
//     .version([
//       'css/about-style.css',
//       'css/activities-style.css',
//       'css/activity-style.css',
//       'css/agency-style.css',
//       'css/calendar-style.css',
//       'css/common.css',
//       'css/free-style.css',
//       'css/guide-style.css',
//       'css/home-style.css',
//       'css/reservation-style.css',
//       'css/send-offer-style.css',
//       'css/user-account-style.css',
//       'css/user-reservations-style.css',
//       'js/activities-scripts.js',
//       'js/activity-scripts.js',
//       'js/agency-scripts.js',
//       'js/calendarpage-scripts.js',
//       'js/common.js',
//       'js/fixed-sidebar.js',
//       'js/free-pages-scripts.js',
//       'js/guide-scripts.js',
//       'js/home-scripts.js',
//       'js/instafeed-settings.js',
//       'js/product.tour.js',
//       'js/send-offer-scripts.js',
//       'js/user-account-scripts.js',
//       'js/user-reservations-scripts.js',
//       'js/reservation-scripts.js'
//     ])
// });



elixir((mix) => {
  mix.sass('user-reservations-style.scss')
    .webpack('user-reservations-scripts.js')
    .sass('print-style.scss')
    .sass('activity-print.scss')
    .version([
      'css/user-reservations-style.css',
      'js/user-reservations-scripts.js'
    ])
});