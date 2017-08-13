<?php

return [
  'home' => [
    'styles' => [
      'css/jquery-ui.min.css',
      'libs/product-tour/product-tour.min.css',
      'css/jcf.custom.min.css',
      'css/home-style.min.css'
    ],
    'scripts' => [
      'js/product.tour.min.js',
      'libs/product-tour/product-tour.min.js',
      'libs/jcf/js/jcf.js',
      'libs/jcf/js/jcf.select.js',
      'js/chosen.jquery.min.js',
    ]
  ],


  'user' => [
    'styles' => [
      'css/userpage-style.min.css'
    ],
    'scripts' => [
      'js/user-scripts.min.js'
    ]
  ],


  'reservation' => [
    'styles' => [
      'libs/product-tour/product-tour.min.css',
      'css/offer-items.min.css',
      'css/reservation-style.min.css',
      'css/reservation-sidebar.min.css'
    ],
    'scripts' => [
      'js/product.tour.min.js',
      'libs/product-tour/product-tour.min.js',
      'js/chosen.jquery.min.js',
      'js/fixed-sidebar.min.js'
    ]
  ],


  'guide' => [
    'styles' => [
      'css/guide-style.min.css'
    ],
    'scripts' => [
      'js/guide-scripts.min.js'
    ]
  ],


  'free' => [

    'walking' => [
      'styles' => [
        'css/tripadvisor.min.css',
        'css/instafeed/instafeed.min.css',
        'css/free-style.min.css'
      ],
      'scripts' => [
        'js/instafeed/instafeed.min.js',
        'js/instafeed/instafeed-settings.min.js',
        'js/free-pages-scripts.min.js'
      ]
    ],

    'bicycle' => [
      'styles' => [
        'css/tripadvisor.min.css',
        'css/jquery-ui.min.css',
        'css/jcf.custom.min.css',
        'css/instafeed/instafeed.min.css',
        'libs/mapbox-gl/mapbox-gl.min.css',
        'css/free-style.min.css'
      ],
      'scripts' => [
        'js/chosen.jquery.min.js',
        'js/instafeed/instafeed.min.js',
        'libs/jcf/js/jcf.js',
        'libs/jcf/js/jcf.select.js',
        'js/ResizeSensor.min.js',
        'libs/mapbox-gl/mapbox-gl.js',
        'js/free-pages-scripts.min.js'
      ]
    ],

    'bus' => [
      'styles' => [
        'css/tripadvisor.min.css',
        'css/jquery-ui.min.css',
        'css/jcf.custom.min.css',
        'css/instafeed/instafeed.min.css',
        'css/free-style.min.css'
      ],
      'scripts' => [
        'js/chosen.jquery.min.js',
        'js/instafeed/instafeed.min.js',
        'libs/jcf/js/jcf.js',
        'libs/jcf/js/jcf.select.js',
        'js/ResizeSensor.min.js',
        'https://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initGuideMaps',
        'js/free-pages-scripts.min.js'
      ]
    ],

    'cultural' => [
      'styles' => [
        'css/tripadvisor.min.css',
        'css/jquery-ui.min.css',
        'css/jcf.custom.min.css',
        'css/instafeed/instafeed.min.css',
        'css/free-style.min.css'
      ],
      'scripts' => [
        'js/chosen.jquery.min.js',
        'js/instafeed/instafeed.min.js',
        'libs/jcf/js/jcf.js',
        'libs/jcf/js/jcf.select.js',
        'js/ResizeSensor.min.js',
        'https://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initGuideMaps',
        'js/free-pages-scripts.min.js'
      ]
    ]
  ],


  'calendar' => [
    'styles' => [
      'link' => 'libs/fullcalendar/fullcalendar.css',
      [
        'media' => 'print',
        'link' => 'libs/fullcalendar/fullcalendar.print.css'
      ],
      'css/reservation-sidebar.min.css',
      'css/calendar-style.min.css'
    ],
    'scripts' => [
      'libs/fullcalendar/lib/moment.min.js',
      'libs/fullcalendar/fullcalendar.min.js',
      'libs/fullcalendar/es.js',
      'libs/fullcalendar/pt.js',
      'js/fixed-sidebar.min.js',
      'js/calendarpage-scripts.min.js'
    ]
  ],


  'agencies' => [

    'single' => [
      'styles' => [
        'css/jquery-ui.min.css',
        'css/chosen/chosen.min.css',
        'css/instafeed/instafeed.min.css',
        'css/jcf.custom.min.css',
        'css/offer-items.min.css',
        'css/agency-style.min.css'
      ],
      'scripts' => [
        'js/chosen.jquery.min.js',
        'js/instafeed/instafeed.min.js',
        'js/instafeed/instafeed-settings.min.js',
        'libs/jcf/js/jcf.js',
        'libs/jcf/js/jcf.select.js',
        'https://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initAgencyMap',
        'js/agency-scripts.min.js',
      ]
    ],

    'list' => [
      'styles' => [

      ],
      'scripts' => [

      ]
    ]
  ],


  'activities' => [

    'single' => [
      'styles' => [
        'libs/product-tour/product-tour.min.css',
        'css/jquery-ui.min.css',
        'css/chosen/chosen.min.css',
        'css/jcf.custom.min.css',
        'css/prettyPhoto.min.css',
        'css/instafeed/instafeed.min.css',
        'css/offer-items.min.css',
        'css/activity-style.min.css'
      ],
      'scripts' => [
        'js/product.tour.min.js',
        'libs/product-tour/product-tour.min.js',
        'js/moment.js',
        'libs/jcf/js/jcf.js',
        'libs/jcf/js/jcf.select.js',
        'js/chosen.jquery.min.js',
        'js/instafeed/instafeed.min.js',
        'js/instafeed/instafeed-settings.min.js',
        'js/jquery.prettyPhoto.js', //Gallery and currency/language pop-up
        'https://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initMap',
        'js/activity-scripts.min.js'
      ]
    ],

    'list' => [
      'styles' => [
        'owl-carousel/owl.carousel.css',
        'owl-carousel/owl.theme.css',
        'libs/product-tour/product-tour.min.css',
        'css/activities-style.min.css'
      ],
      'scripts' => [
        'js/product.tour.min.js',
        'libs/product-tour/product-tour.min.js',
        'js/chosen.jquery.min.js',
        'owl-carousel/owl.carousel.min.js',
        'libs/jquery-ui/slider/jquery-ui.min.js',
        'js/activities-scripts.min.js'
      ]
    ]
  ],

  'about' => [
    'styles' => [
      'css/about-style.min.css'
    ]
  ],

  'login' => [
    'styles' => [

    ],
    'scripts' => [

    ]
  ],

  'register' => [
    'styles' => [

    ],
    'scripts' => [

    ]
  ]
];