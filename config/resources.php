<?php

return [
    'home' => [
        'styles' => [
          'css/home-style.css'
        ],
        'scripts' => [
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
          'js/reservation-scripts.js'
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
        'js/free-pages-scripts.js'
      ]
    ],

    'bicycle' => [
      'styles' => [
        'css/free-style.css'
      ],
      'scripts' => [
        'js/free-pages-scripts.js'
      ]
    ],

    'bus' => [
      'styles' => [
        'css/free-style.css'
      ],
      'scripts' => [
        'js/free-pages-scripts.js',
        [
          'link' => 'https://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initGuideMaps'
        ]
      ]
    ],

    'cultural' => [
      'styles' => [
        'css/free-style.css'
      ],
      'scripts' => [
        'js/free-pages-scripts.js',
        [
          'link' => 'https://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initGuideMaps'
        ]
      ]
    ]
  ],


  'calendar' => [
    'styles' => [
      'css/calendar-style.css'
    ],
    'scripts' => [
      'js/calendarpage-scripts.js'
    ]
  ],


  'agencies' => [

    'single' => [
      'styles' => [
        'css/agency-style.css'
      ],
      'scripts' => [
        [
          'link' =>  'https://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initAgencyMap'
        ],
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
        [
          'link' => 'https://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initMap'
        ],
        'js/activity-scripts.js'
      ]
    ],

    'list' => [
      'styles' => [
        'css/activities-style.css'
      ],
      'scripts' => [
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
  ],

  'routes' => [
    'styles' => [
      'css/routes.css'
    ]
  ]
];