<?php

return [
    'home' => [
        'styles' => [
          'css/home-style.css'
        ],
        'scripts' => [
          'libs/product-tour/product-tour.min.js',
          'libs/jcf/js/jcf.js',
          'libs/jcf/js/jcf.select.js',
          'js/home-scripts.js'
        ]
    ],


    'sendOffer' => [
        'styles' => [
            'css/send-offer-style.css'
        ],
        'scripts' => [
            'js/send-offer-scripts.js'
        ]
    ],


    'user' => [
        'account' => [
            'styles' => [
                'css/user-account-style.css'
            ],
            'scripts' => [
                'js/user-account-scripts.js'
            ]
        ],
        'reservations' => [
            'styles' => [
                'css/user-reservations-style.css'
            ],
            'scripts' => [
                'js/user-reservations-scripts.js'
            ]
        ]
    ],


    'reservation' => [
        'styles' => [
          'css/reservation-style.css',
        ],
        'scripts' => [
          'js/product.tour.js',
          'libs/product-tour/product-tour.min.js',
        ]
    ],


    'guide' => [
        'styles' => [
          'css/guide-style.css'
        ],
        'scripts' => [
          'js/guide-scripts.js'
        ]
    ],


  'free' => [

    'walking' => [
      'styles' => [
        'css/free-style.css'
      ],
      'scripts' => [
        'libs/instafeed/instafeed.min.js',
        'js/instafeed-settings.js',
        'js/free-pages-scripts.js'
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
        'js/free-pages-scripts.js'
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
        'js/free-pages-scripts.js'
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
        'js/free-pages-scripts.js'
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
      'js/calendarpage-scripts.js'
    ]
  ],


  'agencies' => [

    'single' => [
      'styles' => [
        'css/agency-style.css'
      ],
      'scripts' => [
        'libs/instafeed/instafeed.min.js',
        'js/instafeed-settings.js',
        'libs/jcf/js/jcf.js',
        'libs/jcf/js/jcf.select.js',
        'https://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initAgencyMap',
        'js/agency-scripts.js',
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
        'libs/product-tour/product-tour.min.js',
        'js/moment.js',
        'libs/jcf/js/jcf.js',
        'libs/jcf/js/jcf.select.js',
        'libs/instafeed/instafeed.min.js',
        'https://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initMap',
        'js/activity-scripts.js'
      ]
    ],

    'list' => [
      'styles' => [
        'css/activities-style.css'
      ],
      'scripts' => [
        'libs/jquery-ui/slider/jquery-ui.min.js',
        'js/activities-scripts.js'
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