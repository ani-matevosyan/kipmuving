const elixir = require('laravel-elixir');

// elixir((mix) => {
//   mix.sass('about-style.scss')
//     .sass('activities.scss')
//     .sass('activity.scss')
//     .sass('agencies.scss')
//     .sass('calendar-style.scss')
//     .sass('common.scss')
//     .sass('free-style.scss')
//     .sass('guide-style.scss')
//     .sass('home.scss')
//     .sass('print-style.scss')
//     .sass('activity-print.scss')
//     .sass('reservation-style.scss')
//     .sass('send-offer-style.scss')
//     .sass('user-account.scss')
//     .sass('user-reservations.scss')
//     .sass('coupon-print.scss')
//     .sass('routes.scss')
//     .sass('admin-agency-common.scss')
//     .sass('admin-agency-reservations.scss')
//     .sass('admin-agency-activities.scss')
//     .sass('admin-agency-providers.scss')
//     .webpack('activities.js')
//     .webpack('activity.js')
//     .webpack('agencies.js')
//     .webpack('calendarpage-scripts.js')
//     .webpack('common.js')
//     .webpack('fixed-sidebar.js')
//     .webpack('free-pages-scripts.js')
//     .webpack('guide-scripts.js')
//     .webpack('home.js')
//     .webpack('instafeed-settings.js')
//     .webpack('product.tour.js')
//     .webpack('send-offer-scripts.js')
//     .webpack('user-account.js')
//     .webpack('user-reservations.js')
//     .webpack('reservation-scripts.js')
//     .webpack('routes.js')
//     .webpack('admin-agency-common.js')
//     .webpack('admin-agency-reservations.js')
//     .webpack('admin-agency-activities.js')
//     .webpack('admin-agency-providers.js')
//     .version([
//       'css/about-style.css',
//       'css/activities.css',
//       'css/activity.css',
//       'css/agencies.css',
//       'css/calendar-style.css',
//       'css/common.css',
//       'css/free-style.css',
//       'css/guide-style.css',
//       'css/home.css',
//       'css/reservation-style.css',
//       'css/send-offer-style.css',
//       'css/user-account.css',
//       'css/user-reservations.css',
//       'css/routes.css',
//       'css/admin-agency-common.css',
//       'css/admin-agency-reservations.css',
//       'css/admin-agency-activities.css',
//       'css/admin-agency-providers.css',
//       'js/activities.js',
//       'js/activity.js',
//       'js/agencies.js',
//       'js/calendarpage-scripts.js',
//       'js/common.js',
//       'js/fixed-sidebar.js',
//       'js/free-pages-scripts.js',
//       'js/guide-scripts.js',
//       'js/home.js',
//       'js/instafeed-settings.js',
//       'js/product.tour.js',
//       'js/send-offer-scripts.js',
//       'js/user-account.js',
//       'js/user-reservations.js',
//       'js/reservation-scripts.js',
//       'js/routes.js',
//       'js/admin-agency-common.js',
//       'js/admin-agency-reservations.js',
//       'js/admin-agency-activities.js',
//       'js/admin-agency-providers.js',
//     ])
// });



elixir((mix) => {
  mix.sass('activity.scss')
    .webpack('agencies.js')
    .version([
      'css/activity.css',
      'js/agencies.js',
    ])
});