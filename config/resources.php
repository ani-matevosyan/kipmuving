<?php

return [
  'home' => [
    'styles' => [
      'css/home-style.css'
    ],
    'scripts' => [
      'js/product.tour.min.js',
      'libs/product-tour/product-tour.min.js',
      'libs/owl-carousel/owl.carousel.min.js',
      'libs/jcf/js/jcf.js',
      'libs/jcf/js/jcf.select.js',
      'js/home-scripts.min.js'
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
      'css/reservation-style.css',
    ],
    'scripts' => [
      'js/product.tour.min.js',
      'libs/product-tour/product-tour.min.js',
      'js/fixed-sidebar.min.js'
    ]
  ],


  'guide' => [
    'styles' => [
      'css/guide-style.css'
    ],
    'scripts' => [
      'js/guide-scripts.min.js'
    ]
  ],


  'free' => [

    'walking' => [
      'styles' => [
        'css/free-style.css'
      ],
      'scripts' => [
        'libs/instafeed/instafeed.min.js',
        'libs/instafeed/instafeed-settings.min.js',
        'js/free-pages-scripts.min.js'
      ]
    ],

    'bicycle' => [
      'styles' => [
        'css/free-style.css'
      ],
      'scripts' => [
        'libs/instafeed/instafeed.min.js',
        'libs/jcf/js/jcf.js',
        'libs/jcf/js/jcf.select.js',
        'js/ResizeSensor.min.js',
        'libs/mapbox-gl/mapbox-gl.js',
        'js/free-pages-scripts.min.js'
      ]
    ],

    'bus' => [
      'styles' => [
        'css/free-style.css'
      ],
      'scripts' => [
        'libs/instafeed/instafeed.min.js',
        'libs/jcf/js/jcf.js',
        'libs/jcf/js/jcf.select.js',
        'js/ResizeSensor.min.js',
        'https://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initGuideMaps',
        'js/free-pages-scripts.min.js'
      ]
    ],

    'cultural' => [
      'styles' => [
        'css/free-style.css'
      ],
      'scripts' => [
        'libs/instafeed/instafeed.min.js',
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
      [
        'media' => 'print',
        'link' => 'libs/fullcalendar/fullcalendar.print.css'
      ],
      'css/calendar-style.css'
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
        'css/agency-style.css'
      ],
      'scripts' => [
        'libs/instafeed/instafeed.min.js',
        'libs/instafeed/instafeed-settings.min.js',
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
        'css/activity-style.css'
      ],
      'scripts' => [
        'js/product.tour.min.js',
        'libs/product-tour/product-tour.min.js',
        'js/moment.js',
        'libs/jcf/js/jcf.js',
        'libs/jcf/js/jcf.select.js',
        'libs/chosen/chosen.jquery.min.js',
        'libs/instafeed/instafeed.min.js',
        'libs/instafeed/instafeed-settings.min.js',
        'libs/prettyPhoto/jquery.prettyPhoto.js', //Gallery and currency/language pop-up
        'https://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initMap',
        'js/activity-scripts.min.js'
      ]
    ],

    'list' => [
      'styles' => [
        'css/activities-style.css'
      ],
      'scripts' => [
        'js/product.tour.min.js',
        'libs/product-tour/product-tour.min.js',
        'libs/jquery-ui/slider/jquery-ui.min.js',
        'js/activities-scripts.min.js'
      ]
    ]
  ],

  'about' => [
    'styles' => [
      'css/about-style.css'
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